<?php

namespace App\Filament\Resources\OrderFormRequests\Pages;

use App\Filament\Resources\OrderFormRequests\OrderFormRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrderFormRequest extends EditRecord
{
    protected static string $resource = OrderFormRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
