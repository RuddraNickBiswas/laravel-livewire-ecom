<?php

namespace App\Filament\Resources\Shop\OrderResource\Widgets;

use App\Filament\Resources\Shop\OrderResource\Pages\ListOrders;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOrdersOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;


    protected function getTablePage(): string
    {
        return ListOrders::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Orders', $this->getPageTableQuery()->count())
                ->chart([5, 10, 20, 15, 25, 30, 35]),
            Stat::make('Open orders', $this->getPageTableQuery()->whereIn('status', ['new', 'processing'])->count())
                ->chart([5,10,20,10,30]),
            Stat::make('Average price', number_format($this->getPageTableQuery()->avg('total_price'), 2))
                ->chart([5,15,25,10,30,25,35,40]),
        ];
    }
}
