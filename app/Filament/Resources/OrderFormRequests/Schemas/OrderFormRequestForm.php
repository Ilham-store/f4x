<?php

namespace App\Filament\Resources\OrderFormRequests\Schemas;

use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class OrderFormRequestForm
{
    protected static function updateTotals(Get $get, Set $set): void
    {
        $items = $get('items') ?? [];

        $subtotal = 0;
    
        foreach ($items as $item) {
            $qty = $item['quantity'] ?? 1;
    
            if (!empty($item['product_id'])) {
                $product = Product::find($item['product_id']);
                $price = $product?->price ?? 0;
    
                $subtotal += $price * $qty;
            }
        }
    
        $additional = $get('additional_cost') ?? 0;
        $discount = $get('discount') ?? 0;
    
        $finalSubtotal = $subtotal + $additional - $discount;
    
        $set('subtotal', $finalSubtotal);
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Produk')
                ->columnSpanFull()
                ->schema([
                    Repeater::make('items')
                    ->relationship()
                    ->live()
                    ->schema([
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        
                                $product = Product::find($state);
                        
                                $unitPrice = $product?->price ?? 0;
                                $qty = $get('quantity') ?? 1;
                        
                                // Simpan harga asli (opsional tapi bagus)
                                $set('unit_price', $unitPrice);
                        
                                // Set total ke field price
                                $set('price', $unitPrice * $qty);
                        
                                self::updateTotals($get, $set);
                            }),

                        Hidden::make('unit_price'),
                
                        TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set) {

                                $unitPrice = $get('unit_price') ?? 0;
                                $qty = $get('quantity') ?? 1;
                        
                                $set('price', $unitPrice * $qty);
                        
                                self::updateTotals($get, $set);
                            }),

                        Hidden::make('unit_price'),

                        TextInput::make('price')
                            ->numeric()
                            ->readOnly()
                            ->live()
                            ->dehydrated()
                            ->prefix('Rp'),
                            
                    ])
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        self::updateTotals($get, $set);
                    }),
                ]),

                Section::make('Pricing')
                ->columnSpanFull()
                ->schema([

                    TextInput::make('additional_cost')
                    ->numeric()
                    ->prefix('Rp')
                    ->live(onBlur: true)
                    ->default(0)
                    ->afterStateUpdated(fn (Get $get, Set $set) =>
                        self::updateTotals($get, $set)
                    ),

                    TextInput::make('discount')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Get $get, Set $set) =>
                        self::updateTotals($get, $set)
                    ),

                    TextInput::make('subtotal')
                    ->numeric()
                    ->prefix('Rp')
                    ->readOnly()
                    ->dehydrated()
                    ->live(),
                ]),

                Section::make('Data Customer')
                    ->columnSpanFull()
                    ->schema([

                        TextInput::make('token')
                        ->disabled()
                        ->dehydrated(),

                        TextInput::make('customer_name')->disabled(),
                        TextInput::make('customer_phone')->disabled(),
                        TextInput::make('customer_instagram')->disabled(),

                        Select::make('payment_method')
                            ->options([
                                'cash' => 'Cash',
                                'transfer' => 'Transfer',
                            ])
                            ->disabled(),

                        Select::make('pickup_method')
                            ->options([
                                'courier' => 'Kurir',
                                'self_pickup' => 'Ambil Sendiri',
                            ])
                            ->disabled(),

                        DatePicker::make('pickup_date')->disabled(),
                        TimePicker::make('pickup_time')->disabled(),

                        Textarea::make('delivery_address')
                            ->columnSpanFull()
                            ->disabled(),

                        Textarea::make('greeting_card')
                            ->columnSpanFull()
                            ->disabled(),

                        Textarea::make('balloon_message')
                            ->columnSpanFull()
                            ->disabled(),

                        Textarea::make('note')
                            ->columnSpanFull()
                            ->disabled(),
                    ])
                    ->visible(fn ($record) => $record?->status !== 'pending'),

                Section::make('Status')
                    ->columnSpanFull()
                    ->schema([
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'submitted' => 'Submitted',
                                'converted' => 'Converted',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('pending')
                            ->required(),
                    ]),
            ]);
    }
}
