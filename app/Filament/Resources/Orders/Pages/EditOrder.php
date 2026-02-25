<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            Action::make('print')
                ->label('Print Invoice')
                ->icon('heroicon-o-printer')
                ->action(fn () => redirect()->route('orders.print', $this->record)),
        ];
    }

    protected function afterSave(): void
    {
        $order = $this->record;

        if ($order->status === 'cancelled' && $order->stock_adjusted) {

            $order->load('items.product');

            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('stock', $item->quantity);
                }
            }

            $order->updateQuietly([
                'stock_adjusted' => false,
            ]);
        }
    }
}
