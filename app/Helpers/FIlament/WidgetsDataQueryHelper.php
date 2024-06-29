<?php

namespace App\Helpers\Filament;

use Filament\Facades\Filament;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class WidgetsDataQueryHelper
{
    public static function getData($model, $filters, $useTenant = false): Collection
    {
        $start = $filters['startDate'] ?? null;
        $end = $filters['endDate'] ?? null;

        $startDate = $start ? Carbon::parse($start) : now()->subYear();
        $endDate = $end ? Carbon::parse($end) : now();

        $diffInMonths = $startDate->diffInMonths($endDate);

        $query = $model::query()
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($useTenant) {
            $query->whereBelongsTo(Filament::getTenant());
        }

        $connectionType = $model::getConnectionResolver()
            ->connection()
            ->getDriverName();

        if ($diffInMonths < 3) {
            if ($connectionType == 'sqlite') {
                return $query->selectRaw('strftime("%Y-%m-%d", created_at) as date, COUNT(*) as aggregate')
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get()
                    ->map(function ($item) {
                        return (object)[
                            'date' => $item->date,
                            'aggregate' => $item->aggregate,
                        ];
                    });
            } else {
                return $query->selectRaw('DATE(created_at) as date, COUNT(*) as aggregate')
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get()
                    ->map(function ($item) {
                        return (object)[
                            'date' => $item->date,
                            'aggregate' => $item->aggregate,
                        ];
                    });
            }
        } else {
            if ($connectionType == 'sqlite') {
                return $query->selectRaw('strftime("%Y-%m", created_at) as date, COUNT(*) as aggregate')
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get()
                    ->map(function ($item) {
                        return (object)[
                            'date' => $item->date,
                            'aggregate' => $item->aggregate,
                        ];
                    });
            } else {
                return $query->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as date, COUNT(*) as aggregate')
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get()
                    ->map(function ($item) {
                        return (object)[
                            'date' => $item->date,
                            'aggregate' => $item->aggregate,
                        ];
                    });
            }
        }
    }
}
