<?php

namespace App\Helpers\Filament;

use Illuminate\Support\Carbon;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class WidgetsDataQueryHelperTrend
{
    public static function getData($model, $filters)
    {
        $start = $filters['startDate'] ?? null;
        $end = $filters['endDate'] ?? null;

        $startDate = $start ? Carbon::parse($start) : now()->subYear();
        $endDate = $end ? Carbon::parse($end) : now();

        $diffInMonths = $startDate->diffInMonths($endDate);

        $dataQuery = Trend::model($model)
            ->between(
                start: $startDate,
                end: $endDate,
            );

        if ($diffInMonths < 3) {
            return $dataQuery->perDay()->count();
        } else {
            return $dataQuery->perMonth()->count();
        }
    }


//     $filters = $this->filters;

//     $data = WidgetsDataQueryHelper::getData(Product::class, $filters);

// return [
//     'datasets' => [
//         [
//             'label' => 'Products',
//             'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
//         ],
//     ],
//     'labels' => $data->map(fn (TrendValue $value) => $value->date),

}
