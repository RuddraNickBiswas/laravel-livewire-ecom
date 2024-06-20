<?php

namespace App\Filament\Resources\Shop\DeliveryAreaResource\Pages;

use App\Filament\Resources\Shop\DeliveryAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeliveryArea extends EditRecord
{
    protected static string $resource = DeliveryAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
