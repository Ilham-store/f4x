<?php

namespace App\Filament\Resources\OrderFormRequests\Pages;

use App\Filament\Resources\OrderFormRequests\OrderFormRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrderFormRequests extends ListRecords
{
    protected static string $resource = OrderFormRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
