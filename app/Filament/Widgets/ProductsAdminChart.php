<?php

namespace App\Filament\Widgets;

use App\Helpers\Filament\WidgetsDataQueryHelper;
use App\Models\Shop\Product;
use App\Traits\Filament\GetChartWidgetsDataQuery;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class ProductsAdminChart extends ChartWidget
{
    use InteractsWithPageFilters , GetChartWidgetsDataQuery;
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Total product added';
    protected static string $color = 'primary';


    protected function getData(): array
    {
        $filters = $this->filters;

        $data = $this->getChartWidgetsDataQuery(Product::query(), $filters, );

    return [
        'datasets' => [
            [
                'label' => 'Products',
                'data' => $data->pluck('aggregate'),
            ],
        ],
        'labels' => $data->pluck('date'),
    ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
