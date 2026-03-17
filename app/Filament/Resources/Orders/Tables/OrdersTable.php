<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Filament\Resources\Orders\Pages\ViewOrder;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')->searchable()->sortable(),

                TextColumn::make('customer_name')->searchable(),

                TextColumn::make('total_amount')
                    ->money('IDR'),

                TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'paid' => 'success',
                    'cancelled' => 'danger',
                    default => 'gray',
                })
                ->action(
                    Action::make('updateStatus')
                        ->mountUsing(fn ($form, $record) => $form->fill([
                            'status' => $record->status,
                        ]))
                        ->modalSubmitActionLabel('Simpan') 
                        ->modalHeading('Update Status Pesanan')
                        ->form([
                            Select::make('status')
                                ->label('Ubah Status Pesanan')
                                ->options([
                                    'pending' => 'Pending',
                                    'paid' => 'Paid',
                                    'cancelled' => 'Cancelled',
                                ])
                                ->required()
                        ])
                        ->action(function (array $data, $record): void {
                            $record->update(['status' => $data['status']]);
                            $orderNumber = $record->order_number;
                            Notification::make()
                                ->title('Status Berhasil Diperbarui')
                                ->body("Pesanan {$orderNumber} kini berstatus: " . ucfirst($data['status']))
                                ->success()
                                ->send();
                        })
                    ),

                TextColumn::make('order_date')->dateTime('d M Y')->sortable(),
            ])->defaultSort('order_date', 'desc')
            
            ->filters([
                SelectFilter::make('status')
                    ->options([
                            'pending' => 'Pending',
                            'paid' => 'Paid',
                            'cancelled' => 'Cancelled',
                        ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('print')
                ->label('Print')
                ->color('success')
                ->icon('heroicon-o-printer')
                ->action(function ($record) {
                    return redirect()->route('orders.print', ['order' => $record]);
                }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
