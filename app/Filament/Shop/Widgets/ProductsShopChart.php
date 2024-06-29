<?php

namespace App\Filament\Shop\Widgets;

use App\Helpers\Filament\WidgetsDataQueryHelper;
use App\Models\Shop\Product;
use App\Traits\Filament\GetChartWidgetsDataQuery;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class ProductsShopChart extends ChartWidget
{
    use InteractsWithPageFilters , GetChartWidgetsDataQuery;
    protected static ?string $heading = 'Products';

    protected static ?int $sort = 2;
    protected function getData(): array
    {
        $filters = $this->filters;

        $data = $this->getChartWidgetsDataQuery(Product::query(), $filters, useTenant:true);

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
