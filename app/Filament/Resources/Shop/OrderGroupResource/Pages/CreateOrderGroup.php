<?php

namespace App\Filament\Resources\Shop\OrderGroupResource\Pages;

use App\Filament\Resources\Shop\OrderGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderGroup extends CreateRecord
{
    protected static string $resource = OrderGroupResource::class;
}
