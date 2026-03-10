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
    public static function getNavigationGroup(): ?string
    {
        return 'Management';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }


    public static function getNavigationBadge(): ?string
    {
        // Menghitung jumlah masing-masing status
        $pending = static::getModel()::where('status', 'pending')->count();
        $submitted = static::getModel()::where('status', 'submitted')->count();

        // Jika keduanya nol, badge tidak akan muncul sama sekali
        if ($pending === 0 && $submitted === 0) {
            return null;
        }

        // Menampilkan format "P: 5 | S: 3"
        return "S: {$submitted} | P: {$pending}";
    }

    public static function getNavigationBadgeColor(): ?string
    {
        // Mengunci warna ke Amber (warning) sesuai permintaan Anda
        return 'warning';
    }
    
    protected static ?string $model = OrderFormRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

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
