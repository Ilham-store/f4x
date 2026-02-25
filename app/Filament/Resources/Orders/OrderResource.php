<?php

namespace App\Filament\Resources\Orders;

use App\Filament\Resources\Orders\Pages\CreateOrder;
use App\Filament\Resources\Orders\Pages\EditOrder;
use App\Filament\Resources\Orders\Pages\ListOrders;
use App\Filament\Resources\Orders\Pages\ViewOrder;
use App\Filament\Resources\Orders\Schemas\OrderForm;
use App\Filament\Resources\Orders\Tables\OrdersTable;
use App\Models\Order;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderResource extends Resource
{
    public static function getNavigationGroup(): ?string
    {
        return 'Management';
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInboxArrowDown;

    protected static ?string $recordTitleAttribute = 'order_number';

    public static function form(Schema $schema): Schema
    {
        return OrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table);
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
            'index' => ListOrders::route('/'),
            'create' => CreateOrder::route('/create'),
            'edit' => EditOrder::route('/{record}/edit'),
            'view' => ViewOrder::route('/{record}'),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
    
        return $data;
    }

    public static function recalculateTotal(callable $set, callable $get): void
{
    $items = $get('items') ?? [];

    $subtotalItems = collect($items)
        ->sum(fn ($item) => $item['subtotal'] ?? 0);

    $extraCost = $get('extra_cost') ?? 0;
    $discountType = $get('discount_type');
    $discountValue = $get('discount_value') ?? 0;

    $discountAmount = 0;

    if ($discountType === 'percent') {
        $discountAmount = $subtotalItems * ($discountValue / 100);
    } elseif ($discountType === 'nominal') {
        $discountAmount = $discountValue;
    }

    $grandTotal = $subtotalItems + $extraCost - $discountAmount;

    if ($grandTotal < 0) {
        $grandTotal = 0;
    }

    $set('total_amount', $subtotalItems);
    $set('grand_total', $grandTotal);
}
}
