<?php

namespace App\Filament\Resources\Shop\OrderGroupResource\Pages;

use App\Enums\OrderGroupStatus;
use App\Filament\Resources\Shop\OrderGroupResource;
use App\Models\Shop\OrderGroup;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Query\Builder;

class ListOrderGroups extends ListRecords
{
    use ExposesTableToWidgets;
    protected static string $resource = OrderGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return OrderGroupResource::getWidgets();
    }


    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            OrderGroupStatus::New->getLabel() => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', OrderGroupStatus::New->value))
                ->badge(OrderGroup::where('status', OrderGroupStatus::New->value)->count()),

                OrderGroupStatus::Verified->getLabel() => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', OrderGroupStatus::Verified->value))
                ->badge(OrderGroup::where('status', OrderGroupStatus::Verified->value)->count()),


                OrderGroupStatus::Cancelled->getLabel() => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', OrderGroupStatus::Cancelled->value))
                ->badge(OrderGroup::where('status', OrderGroupStatus::Cancelled->value)->count()),

                OrderGroupStatus::Refunded->getLabel() => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', OrderGroupStatus::Refunded->value))
                ->badge(OrderGroup::where('status', OrderGroupStatus::Refunded->value)->count()),
        ];
    }
}
