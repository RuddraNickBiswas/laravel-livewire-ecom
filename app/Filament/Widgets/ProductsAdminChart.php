<?php

namespace App\Filament\Widgets;

use App\Models\Shop\Product;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class ProductsAdminChart extends ChartWidget
{
    use InteractsWithPageFilters;
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Total product added';
    protected static string $color = 'primary';


    protected function getData(): array
    {

        $start = $this->filters['startDate'];
        $end = $this->filters['endDate'];

        $startDate = $start ? Carbon::parse($start) : now()->subYear();
        $endDate = $end ? Carbon::parse($end) : now();

        $diffInMonths = $startDate->diffInMonths($endDate);

        $dataQuery = Trend::model(Product::class)
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
        return 'bar';
    }
}
