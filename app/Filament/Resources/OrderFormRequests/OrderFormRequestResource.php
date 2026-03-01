<?php

namespace App\Filament\Resources\OrderFormRequests;

use App\Filament\Resources\OrderFormRequests\Pages\CreateOrderFormRequest;
use App\Filament\Resources\OrderFormRequests\Pages\EditOrderFormRequest;
use App\Filament\Resources\OrderFormRequests\Pages\ListOrderFormRequests;
use App\Filament\Resources\OrderFormRequests\Schemas\OrderFormRequestForm;
use App\Filament\Resources\OrderFormRequests\Tables\OrderFormRequestsTable;
use App\Models\OrderFormRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrderFormRequestResource extends Resource
{
    protected static ?string $model = OrderFormRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'token';

    public static function form(Schema $schema): Schema
    {
        return OrderFormRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrderFormRequestsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrderFormRequests::route('/'),
            'create' => CreateOrderFormRequest::route('/create'),
            'edit' => EditOrderFormRequest::route('/{record}/edit'),
        ];
    }
}
