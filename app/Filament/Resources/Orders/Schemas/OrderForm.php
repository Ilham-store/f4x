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
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

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
                            ->tel()
                            ->required()
                            ->numeric()
                            ->mask('9999999999999')
                            ->stripCharacters(['-', ' ', '+']),
        
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
                            ->nullable()
                            ->required(),
                        
                        TimePicker::make('pickup_time')
                            ->label('Jam Pengambilan')
                            ->seconds(false)
                            ->nullable()
                            ->required(),

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
                                ->allowHtml()
                                ->getOptionLabelFromRecordUsing(function ($record, \Filament\Forms\Components\Select $component) {
                                    // Logika path gambar
                                    $imagePath = is_array($record->images) ? ($record->images[0] ?? null) : $record->image;
                                    
                                    if ($imagePath) {
                                        $filename = basename($imagePath);
                                        $imageUrl = url('/product-image/' . $filename);
                                    } else {
                                        $imageUrl = 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&background=random';
                                    }
                            
                                    // CEK STATUS READONLY / VIEW MODE
                                    $isDisabled = $component->isDisabled();
                            
                                    // Jika readonly, kursor biasa. Jika bisa diedit, kursor zoom.
                                    $cursorStyle = $isDisabled ? 'cursor: default;' : 'cursor: zoom-in;';
                            
                                    // Hanya masukkan script popup jika TIDAK SEDANG readonly
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
                                ->minValue(1)
                                ->required()
                                ->live(onBlur: true)
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
                                
                                        if (! $product) return;
                                
                                        // quantity lama dari order item
                                        $existingQty = (int) ($get('quantity') ?? 0);
                                
                                        // stok yang tersedia + qty lama
                                        $availableStock = $product->stock + $existingQty;
                                
                                        if ($value > $availableStock) {
                                            $fail("Stok tidak mencukupi. Stok tersedia: {$product->stock}");
                                        }
                                    };
                                }),                          
                                
                            TextInput::make('price')
                                ->numeric()
                                ->prefix('Rp')
                                ->required()
                                ->disabled()
                                ->dehydrated(),
                    
                            TextInput::make('subtotal')
                                ->numeric()
                                ->prefix('Rp')
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
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated()
                            ->required(),
        
                        TextInput::make('extra_cost')
                            ->label('Biaya Tambahan')
                            ->prefix('Rp')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->live(onBlur: true)
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
                            ->reactive()
                            ->default('nominal'),
                        
                        TextInput::make('discount_value')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->live(onBlur: true)
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
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated()
                            ->required(),
                    ]),
            ]);
    }
}