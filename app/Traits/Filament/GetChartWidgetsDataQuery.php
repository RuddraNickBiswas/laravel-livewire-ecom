<?php

namespace App\Traits\Filament;

use Filament\Facades\Filament;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

trait GetChartWidgetsDataQuery
{
    public function getChartWidgetsDataQuery(Builder $query, array $filters, bool $useTenant = false): Collection
    {
        $start = $filters['startDate'] ?? null;
        $end = $filters['endDate'] ?? null;

        $startDate = $start ? Carbon::parse($start) : now()->subYear();
        $endDate = $end ? Carbon::parse($end) : now();

        $diffInMonths = $startDate->diffInMonths($endDate);

        $query->whereBetween('created_at', [$startDate, $endDate]);

        if ($useTenant) {
            $query->whereBelongsTo(Filament::getTenant());
        }

        $connectionType = $query->getConnection()->getDriverName();

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
