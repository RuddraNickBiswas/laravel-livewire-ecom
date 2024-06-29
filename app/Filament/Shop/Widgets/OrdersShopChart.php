<?php

namespace App\Filament\Shop\Widgets;

use App\Helpers\Filament\WidgetsDataQueryHelper;
use App\Models\Shop\Order;
use App\Traits\Filament\GetChartWidgetsDataQuery;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\TrendValue;

class OrdersShopChart extends ChartWidget
{ use InteractsWithPageFilters, GetChartWidgetsDataQuery;

    protected static ?string $heading = "Total order placed";

    protected static ?int $sort = 3;

    // protected static string $color = 'info';


    protected function getData(): array
    {


        $filters = $this->filters;

        $data = $this->getChartWidgetsDataQuery(Order::query(), $filters, useTenant:true);

    return [
        'datasets' => [
            [
                'label' => 'Users Order',
                'data' => $data->pluck('aggregate'),
            ],
        ],
        'labels' => $data->pluck('date'),
    ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
