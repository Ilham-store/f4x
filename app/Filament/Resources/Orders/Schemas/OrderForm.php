<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                /*
                |--------------------------------------------------------------------------
                | INFORMASI ORDER
                |--------------------------------------------------------------------------
                */
                Section::make('Informasi Order')
                    ->schema([

                        TextInput::make('order_number')
                        ->default(fn () => 'INV-A4F-' . now()->format('YmdHis'))
                        ->disabled()
                        ->dehydrated()
                        ->required(),
                        
                        DatePicker::make('order_date')
                            ->default(now())
                            ->required(),

                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('pending')
                            ->required(),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | INFORMASI CUSTOMER
                |--------------------------------------------------------------------------
                */
                Section::make('Informasi Customer')
                    ->schema([

                        TextInput::make('customer_name')
                            ->required(),
        
                        TextInput::make('customer_phone')
                            ->required()
                            ->numeric(),
        
                        TextInput::make('customer_instagram')
                            ->label('Instagram Customer')
                            ->prefix('@')
                            ->nullable(),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | PEMBAYARAN, PENGAMBILAN & PENGIRIMAN
                |--------------------------------------------------------------------------
                */

                Section::make('Pembayaran, Pengambilan, dan Pengiriman')
                    ->columnSpanFull()
                    ->schema([

                        Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'transfer' => 'Transfer',
                                'cash' => 'Cash',
                            ])
                            ->default('transfer')
                            ->required(),
                        
                        Select::make('pickup_method')
                            ->label('Metode Pengambilan')
                            ->options([
                                'self_pickup' => 'Ambil Sendiri',
                                'courier' => 'Kurir',
                            ])
                            ->default('self_pickup')
                            ->required(),
                        
                        DatePicker::make('pickup_date')
                            ->label('Tanggal Pengambilan')
                            ->nullable(),
                        
                        TimePicker::make('pickup_time')
                            ->label('Jam Pengambilan')
                            ->seconds(false)
                            ->nullable(),

                        Textarea::make('delivery_address')
                                ->required()
                                ->columnSpanFull(),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | GREETING & CATATAN
                |--------------------------------------------------------------------------
                */
                Section::make('Greeting & Catatan')
                ->columnSpanFull()
                ->schema([
                    Textarea::make('greeting_card')
                        ->label('Isi Greeting Card')
                        ->rows(3)
                        ->nullable()
                        ->columnSpanFull(),
                    
                    Textarea::make('balloon_message')
                        ->label('Ucapan di Balon')
                        ->rows(3)
                        ->nullable()
                        ->columnSpanFull(),
    
    
                    Textarea::make('note')
                        ->label('Catatan / Ucapan')
                        ->nullable()
                        ->columnSpanFull(),
                ]),

                /*
                |--------------------------------------------------------------------------
                | ITEM PESANAN
                |--------------------------------------------------------------------------
                */
                
                Section::make('Item Pesanan')
                ->columnSpanFull()
                ->schema([
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
    
                                    if (! $state) {
                                        $set('price', null);
                                        $set('subtotal', null);
                                        return;
                                    }
                                
                                    $product = Product::find($state);
                                
                                    if (! $product) return;
                                
                                    $set('price', (float) $product->price);
                                    $set('quantity', 1);
                                    $set('subtotal', (float) $product->price);
    
                                    $items = $get('../../items') ?? [];
    
                                    $total = collect($items)
                                        ->sum(fn ($item) => $item['subtotal'] ?? 0);
    
                                    $set('../../total_amount', $total);
                                    $set('../../grand_total', $total);
                                }),
                    
                            TextInput::make('quantity')
                                ->numeric()
                                ->default(1)
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
    
                                    $price = (float) $get('price');
                                    $qty   = (int) $state;
                            
                                    $set('subtotal', $price * $qty);
    
                                    $items = $get('../../items') ?? [];
    
                                    $total = collect($items)
                                        ->sum(fn ($item) => $item['subtotal'] ?? 0);
    
                                    $set('../../total_amount', $total);
                                    $set('../../grand_total', $total);
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
                ]),

                /*
                |--------------------------------------------------------------------------
                | RINGKASAN PEMBAYARAN
                |--------------------------------------------------------------------------
                */
                Section::make('Ringkasan Pembayaran')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('total_amount')
                            ->numeric()
                            ->disabled()
                            ->dehydrated()
                            ->required(),
        
                        TextInput::make('extra_cost')
                            ->label('Biaya Tambahan')
                            ->numeric()
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        
                                $subtotal = (float) $get('total_amount');
                                $discountType = $get('discount_type');
                                $discountValue = (float) $get('discount_value');
                        
                                $discountAmount = 0;
                        
                                if ($discountType === 'percent') {
                                    $discountAmount = $subtotal * ($discountValue / 100);
                                } elseif ($discountType === 'nominal') {
                                    $discountAmount = $discountValue;
                                }
                        
                                $grand = $subtotal + $state - $discountAmount;
                        
                                $set('grand_total', max($grand, 0));
                            }),
                        
                        Select::make('discount_type')
                            ->options([
                                'percent' => 'Persen (%)',
                                'nominal' => 'Nominal (Rp)',
                            ])
                            ->reactive(),
                        
                        TextInput::make('discount_value')
                            ->numeric()
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        
                                $subtotal = (float) $get('total_amount');
                                $extra = (float) $get('extra_cost');
                                $discountType = $get('discount_type');
                        
                                $discountAmount = 0;
                        
                                if ($discountType === 'percent') {
                                    $discountAmount = $subtotal * ($state / 100);
                                } elseif ($discountType === 'nominal') {
                                    $discountAmount = $state;
                                }
                        
                                $grand = $subtotal + $extra - $discountAmount;
                        
                                $set('grand_total', max($grand, 0));
                            }),
                        
                        TextInput::make('grand_total')
                            ->label('Grand Total')
                            ->numeric()
                            ->disabled()
                            ->dehydrated()
                            ->required(),
                    ]),
            ]);
    }
}