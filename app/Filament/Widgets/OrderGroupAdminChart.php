<?php

namespace App\Filament\Widgets;

use App\Helpers\Filament\WidgetsDataQueryHelper;
use App\Models\Shop\Order;
use App\Models\Shop\OrderGroup;
use App\Traits\Filament\GetChartWidgetsDataQuery;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;


class OrderGroupAdminChart extends ChartWidget
{
    use InteractsWithPageFilters, GetChartWidgetsDataQuery;

    protected static ?string $heading = "Total order placed";

    protected static ?int $sort = 2;

    // protected static string $color = 'info';


    protected function getData(): array
    {


        $filters = $this->filters;

        $data = $this->getChartWidgetsDataQuery(OrderGroup::query(), $filters, );

        return [
            'datasets' => [
                [
                    'label' => 'Order Group',
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
