<?php

namespace App\Filament\Resources\Shop\OrderGroupResource\Pages;

use App\Filament\Resources\Shop\OrderGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderGroups extends ListRecords
{
    protected static string $resource = OrderGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
