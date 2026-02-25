<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentOrders extends TableWidget
{
    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => order::query()->latest()->limit(5))
            ->columns([
                TextColumn::make('order_number'),
                TextColumn::make('customer_name'),
                TextColumn::make('total_amount')
                    ->money('IDR'),
                BadgeColumn::make('status'),
                TextColumn::make('order_date')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
