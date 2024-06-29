<?php

namespace App\Filament\Shop\Widgets;

use App\Enums\OrderStatus;
use App\Models\Shop\Order;
use App\Models\Shop\Product;
use App\Traits\Filament\ApplyStatsWidgetsPageFilters;
use Filament\Facades\Filament;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsShopOverview extends BaseWidget
{
    use InteractsWithPageFilters, ApplyStatsWidgetsPageFilters;


    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $start = $this->filters['startDate'];
        $end = $this->filters['endDate'];

        return [
            Stat::make(
                'Total Orders',
                fn () => $this->applyStatsWidgetsPageFilters(Order::whereBelongsTo(Filament::getTenant()), $start, $end)->count()
            )
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->description('All Orders')
            ->descriptionIcon('heroicon-m-shopping-bag')
            ->color('success'),

            Stat::make(
                'Completed Order',
                fn () => $this->applyStatsWidgetsPageFilters(Order::whereBelongsTo(Filament::getTenant())->where('status', OrderStatus::Delivered), $start, $end)->count()
            )
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->description('Completed Orders')
            ->descriptionIcon('heroicon-m-shopping-bag')
            ->color('success'),

            Stat::make(
                'All Products',
                fn () => $this->applyStatsWidgetsPageFilters(Product::whereBelongsTo(Filament::getTenant()), $start, $end)->count()
            )
            ->description('Total Products')
            ->descriptionIcon('heroicon-m-squares-2x2')
            ->chart([5, 10, 25, 20, 30, 40, 35])
            ->color('success'),
        ];
    }

}
