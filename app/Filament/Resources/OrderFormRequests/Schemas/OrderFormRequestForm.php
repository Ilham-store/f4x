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
                            ->relationship(
                                'product', 
                                'name',
                                modifyQueryUsing: fn ($query) => $query->where('is_active', true) 
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->allowHtml()
                            ->getOptionLabelFromRecordUsing(function ($record,Select $component) {
                                
                                $imagePath = is_array($record->images) ? ($record->images[0] ?? null) : $record->image;
                                
                                if ($imagePath) {
                                    $filename = basename($imagePath);
                                    $imageUrl = url('/product-image/' . $filename);
                                } else {
                                    $imageUrl = 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&background=random';
                                }

                                $isDisabled = $component->isDisabled();
                                $cursorStyle = $isDisabled ? 'cursor: default;' : 'cursor: zoom-in;';

                                $onClickScript = '';
                                if (! $isDisabled) {
                                    $onClickScript = "onclick=\"
                                        event.stopPropagation(); 
                                        event.preventDefault(); 
                                        
                                        const overlay = document.createElement('div'); 
                                        overlay.style.cssText = 'position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.75); z-index:99999; display:flex; align-items:center; justify-content:center; backdrop-filter:blur(4px);'; 
                                        
                                        ['mousedown', 'mouseup', 'click', 'pointerdown', 'pointerup'].forEach(ev => {
                                            overlay.addEventListener(ev, e => e.stopPropagation());
                                        });
                                        
                                        const closeModal = () => {
                                            if (document.body.contains(overlay)) {
                                                document.body.removeChild(overlay);
                                            }
                                        };
                                        
                                        overlay.onclick = (e) => { 
                                            if(e.target === overlay) closeModal(); 
                                        }; 
                                        
                                        const modal = document.createElement('div'); 
                                        modal.style.cssText = 'position:relative; background:white; padding:16px; border-radius:12px; display:flex; flex-direction:column; align-items:center; box-shadow:0 25px 50px -12px rgba(0,0,0,0.5); max-width:90vw; max-height:90vh;'; 
                                        
                                        const closeBtn = document.createElement('button'); 
                                        closeBtn.innerHTML = '✕'; 
                                        closeBtn.style.cssText = 'position:absolute; top:-12px; right:-12px; width:30px; height:30px; background:#ef4444; color:white; border:none; border-radius:50%; font-weight:bold; cursor:pointer; box-shadow:0 4px 6px rgba(0,0,0,0.1); display:flex; align-items:center; justify-content:center; font-size:14px; padding:0; line-height:1; z-index:10;'; 
                                        closeBtn.onclick = () => closeModal(); 
                                        
                                        const img = document.createElement('img'); 
                                        img.src = this.src; 
                                        img.style.cssText = 'max-width:100%; max-height:60vh; border-radius:8px; object-fit:contain;'; 
                                        
                                        const btn = document.createElement('button'); 
                                        btn.innerHTML = 'Pilih Produk Ini'; 
                                        btn.style.cssText = 'margin-top:16px; width:100%; padding:10px; background:#AD8331; color:white; border:none; border-radius:8px; font-weight:bold; cursor:pointer; font-size:15px;'; 
                                        
                                        const optionRow = this.closest('.product-option-row');
                                        btn.onclick = () => { 
                                            closeModal(); 
                                            if(optionRow) optionRow.click(); 
                                        }; 
                                        
                                        modal.appendChild(closeBtn); 
                                        modal.appendChild(img); 
                                        modal.appendChild(btn); 
                                        overlay.appendChild(modal); 
                                        document.body.appendChild(overlay);
                                    \"";
                                }

                                return "
                                    <div class='product-option-row' style='display: flex; align-items: center; gap: 12px; padding: 4px 0;'>
                                        <img 
                                            src='{$imageUrl}' 
                                            alt='{$record->name}' 
                                            style='width: 45px; height: 45px; border-radius: 6px; object-fit: cover; border: 1px solid #e5e7eb; {$cursorStyle}' 
                                            {$onClickScript}
                                        />
                                        <div style='display: flex; flex-direction: column;'>
                                            <span style='font-weight: 600; line-height: 1.2;'>{$record->name}</span>
                                            <span style='font-size: 0.8rem; color: #6b7280; margin-top: 2px;'>
                                                Rp " . number_format($record->price, 0, ',', '.') . " &bull; Stok: <strong style='color: " . ($record->stock > 0 ? '#10b981' : '#ef4444') . ";'>{$record->stock}</strong>
                                            </span>
                                        </div>
                                    </div>
                                ";
                            })
                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                
                                $product = Product::find($state);
                                
                                $unitPrice = $product?->price ?? 0;
                                $qty = $get('quantity') ?? 1;
                                
                                // Simpan harga asli
                                $set('unit_price', $unitPrice);
                                
                                // Set total ke field price
                                $set('price', $unitPrice * $qty);
                                
                                self::updateTotals($get, $set);
                            }),

                        Hidden::make('unit_price'),

                        TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $unitPrice = $get('unit_price') ?? 0;
                                $qty = $get('quantity') ?? 1;
                        
                                $set('price', $unitPrice * $qty);
                        
                                self::updateTotals($get, $set);
                            }),

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
