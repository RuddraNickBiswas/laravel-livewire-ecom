<?php

namespace App\Filament\Shop\Resources\OrderResource\Pages;

use App\Enums\OrderStatus;
use App\Filament\Shop\Resources\OrderResource;
use App\Models\Shop\Order;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    use ExposesTableToWidgets;
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return OrderResource::getWidgets();
    }



    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            OrderStatus::New->getLabel() => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', OrderStatus::New->value))
                ->badge(Order::whereBelongsTo(Filament::getTenant())->where('status', OrderStatus::New->value)->count()),

                OrderStatus::Processing->getLabel() => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', OrderStatus::Processing->value))
                ->badge(Order::whereBelongsTo(Filament::getTenant())->where('status', OrderStatus::Processing->value)->count()),

                OrderStatus::Shipped->getLabel() => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', OrderStatus::Shipped->value))
                ->badge(Order::whereBelongsTo(Filament::getTenant())->where('status', OrderStatus::Shipped->value)->count()),

                OrderStatus::Delivered->getLabel() => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', OrderStatus::Delivered->value))
                ->badge(Order::whereBelongsTo(Filament::getTenant())->where('status', OrderStatus::Delivered->value)->count()),

                OrderStatus::Cancelled->getLabel() => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', OrderStatus::Cancelled->value))
                ->badge(Order::whereBelongsTo(Filament::getTenant())->where('status', OrderStatus::Cancelled->value)->count()),

                OrderStatus::Refunded->getLabel() => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', OrderStatus::Refunded->value))
                ->badge(Order::whereBelongsTo(Filament::getTenant())->where('status', OrderStatus::Refunded->value)->count()),
        ];
    }
}
