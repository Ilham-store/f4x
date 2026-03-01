<?php

namespace App\Filament\Resources\OrderFormRequests\Tables;

use App\Models\Order;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class OrderFormRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('product.name')
                ->label('Produk')
                ->searchable()
                ->sortable(),

                TextColumn::make('customer_name')
                    ->searchable()
                    ->placeholder('-'),

                TextColumn::make('customer_phone')
                    ->placeholder('-'),

                BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'pending',
                        'warning' => 'submitted',
                        'success' => 'converted',
                        'danger' => 'cancelled',
                    ]),

                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('generate_link')
                ->label('Generate Link')
                ->icon('heroicon-o-link')
                ->visible(fn ($record) => $record->status === 'pending')
                ->action(function ($record) {

                    $record->update([
                        'token' => Str::uuid(),
                    ]);
                }),

                Action::make('copy_link')
                    ->label('Copy Link')
                    ->icon('heroicon-o-clipboard')
                    ->visible(fn ($record) => $record->token)
                    ->url(fn ($record) => url('/order-form/' . $record->token))
                    ->openUrlInNewTab(),

                Action::make('convert')
                    ->label('Convert to Order')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'submitted')
                    ->action(function ($record) {

                        $record->load('items.product');
                    
                        $user = Filament::auth()->user();
                    
                        $total = 0;
                    
                        foreach ($record->items as $item) {
                            if (!$item->product) continue;
                            $total += $item->product->price * $item->quantity;
                        }
                    
                        $order = Order::create([
                            'order_number' => 'INV-' . now()->format('YmdHis'),
                            'user_id' => $user->id,
                            'customer_name' => $record->customer_name,
                            'customer_phone' => $record->customer_phone,
                            'customer_instagram' => $record->customer_instagram,
                            'delivery_address' => $record->delivery_address,
                            'payment_method' => $record->payment_method,
                            'pickup_method' => $record->pickup_method,
                            'pickup_date' => $record->pickup_date,
                            'pickup_time' => $record->pickup_time,
                            'greeting_card' => $record->greeting_card,
                            'balloon_message' => $record->balloon_message,
                            'note' => $record->note,
                            'order_date' => now(),
                            'status' => 'pending',
                            'total_amount' => $total,
                            'grand_total' => $total,
                        ]);
                    
                        foreach ($record->items as $item) {
                    
                            if (!$item->product) continue;
                    
                            $order->items()->create([
                                'product_id' => $item->product_id,
                                'quantity' => $item->quantity,
                                'price' => $item->product->price,
                                'subtotal' => $item->product->price * $item->quantity,
                            ]);
                        }
                    
                        $record->update([
                            'status' => 'converted',
                        ]);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
