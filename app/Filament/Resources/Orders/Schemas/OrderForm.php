<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_number')
                ->default(fn () => 'INV-A4F-' . now()->format('YmdHis'))
                ->disabled()
                ->dehydrated()
                ->required(),
                
                DatePicker::make('order_date')
                    ->default(now())
                    ->required(),

                TextInput::make('customer_name')
                    ->required(),

                TextInput::make('customer_phone')
                    ->required()
                    ->numeric(),

                Textarea::make('delivery_address')
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('note')
                    ->label('Catatan / Ucapan')
                    ->nullable()
                    ->columnSpanFull(),


                Repeater::make('items')
                    ->columnSpanFull()
                    ->relationship()
                    ->schema([
                
                        Select::make('product_id')
                            ->relationship(
                                'product',
                                'name',
                                modifyQueryUsing: fn ($query) => $query->where('is_active', true)
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                
                                $product = \App\Models\Product::find($state);
                
                                if ($product) {
                                    $set('price', $product->price);
                                    $set('subtotal', $product->price);
                
                                    // 🔥 HITUNG ULANG TOTAL
                                    $items = $get('../../items') ?? [];
                
                                    $total = collect($items)
                                        ->sum(fn ($item) => $item['subtotal'] ?? 0);
                
                                    $set('../../total_amount', $total);
                                }
                            }),
                
                        TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                
                                $price = $get('price') ?? 0;
                                $subtotal = $price * $state;
                
                                $set('subtotal', $subtotal);
                
                                // 🔥 HITUNG ULANG TOTAL
                                $items = $get('../../items') ?? [];
                
                                $total = collect($items)
                                    ->sum(fn ($item) => $item['subtotal'] ?? 0);
                
                                $set('../../total_amount', $total);
                            })
                            ->rule(function (callable $get) {
                                return function ($attribute, $value, $fail) use ($get) {
                        
                                    $productId = $get('product_id');
                        
                                    if (! $productId) return;
                        
                                    $product = Product::find($productId);
                        
                                    if ($product && $value > $product->stock) {
                                        $fail("Stok tidak mencukupi. Sisa stok: {$product->stock}");
                                    }
                                };
                            }),
                
                        TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->disabled()
                            ->dehydrated(),
                
                        TextInput::make('subtotal')
                            ->numeric()
                            ->disabled()
                            ->dehydrated()
                            ->required(),
                        ]),

                TextInput::make('total_amount')
                    ->numeric()
                    ->disabled()
                    ->dehydrated()
                    ->required(),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
