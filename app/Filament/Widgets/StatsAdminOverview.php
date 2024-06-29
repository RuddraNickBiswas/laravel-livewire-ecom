<?php

namespace App\Filament\Widgets;

use App\Models\Shop\Order;
use App\Models\Shop\OrderGroup;
use App\Models\Shop\Product;
use App\Models\User;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class StatsAdminOverview extends BaseWidget
{
    use InteractsWithPageFilters;


    protected static ?int $sort = 1;

    protected function getStats(): array
    {

        $start = $this->filters['startDate'];
        $end = $this->filters['endDate'];

        // $order = Trend::model(Order::class)
        //     ->between(
        //         start: $start ? Carbon::parse($start) : now()->subYear(),
        //         end: $end ? Carbon::parse($end) : now(),
        //     )
        //     ->perMonth()
        //     ->count();

        return [
            Stat::make(
                'Users',
                fn () =>
                User::when($start, fn ($query) => $query->whereDate('created_at', '>', $start))
                    ->when($end, fn ($query) => $query->whereDate('created_at', '<', $end))
                    ->count()
            )
                ->description('All Users')
                ->descriptionIcon('heroicon-m-user')
                ->chart([5, 10, 15, 20, 25, 30, 35])
                ->color('success'),
            Stat::make(
                'User Order',
                fn () =>
                OrderGroup::when($start, fn ($query) => $query->whereDate('created_at', '>', $start))
                    ->when($end, fn ($query) => $query->whereDate('created_at', '<', $end))
                    ->count()
            )
            ->chart([7, 2, 10, 3, 15, 4, 17])
                ->description('All Orders')
                ->descriptionIcon('heroicon-m-shopping-bag')

                ->color('success'),
            Stat::make(
                'All Product',
                fn () =>
                Product::when($start, fn ($query) => $query->whereDate('created_at', '>', $start))
                    ->when($end, fn ($query) => $query->whereDate('created_at', '<', $end))
                    ->count()
            )
                ->description('total product')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->chart([5, 10, 25, 20, 30, 40, 35])
                ->color('success'),
        ];
    }
}
