<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                ->getStateUsing(fn ($record) => is_array($record->images) ? ($record->images[0] ?? null) : null),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Kategori'),

                TextColumn::make('price')
                    ->money('IDR'),

                TextColumn::make('stock'),

                IconColumn::make('is_active')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])->defaultSort('created_at', 'desc')

            ->filters([
                SelectFilter::make('Kategori')
                    ->relationship('category', 'name'),
                TernaryFilter::make('is_active')

            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
