<?php

namespace App\Filament\Widgets;

use App\Models\Shop\Order;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class OrdersAdminChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = "Total order placed";

    protected static ?int $sort = 2;

    protected static string $color = 'info';


    protected function getData(): array
    {


        $start = $this->filters['startDate'];
        $end = $this->filters['endDate'];

        $startDate = $start ? Carbon::parse($start) : now()->subYear();
        $endDate = $end ? Carbon::parse($end) : now();

        $diffInMonths = $startDate->diffInMonths($endDate);

        $dataQuery = Trend::model(Order::class)
            ->between(
                start: $startDate,
                end: $endDate,
            );

        if ($diffInMonths < 3) {
            $data = $dataQuery->perDay()->count();
        } else {
            $data = $dataQuery->perMonth()->count();
        }

    return [
        'datasets' => [
            [
                'label' => 'Orders',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
