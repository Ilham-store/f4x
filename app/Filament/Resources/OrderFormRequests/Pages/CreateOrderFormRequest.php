<?php

namespace App\Filament\Resources\OrderFormRequests\Pages;

use App\Filament\Resources\OrderFormRequests\OrderFormRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderFormRequest extends CreateRecord
{
    protected static string $resource = OrderFormRequestResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
