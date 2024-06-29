<?php

namespace App\Traits\Filament;

use Illuminate\Database\Eloquent\Builder;
use Filament\Facades\Filament;
use Carbon\Carbon;

trait ApplyStatsWidgetsPageFilters
{
    public function applyStatsWidgetsPageFilters(Builder $query, $start, $end): Builder
    {
        return $query->when($start, fn($query) => $query->whereDate('created_at', '>', Carbon::parse($start)))
                     ->when($end, fn($query) => $query->whereDate('created_at', '<', Carbon::parse($end)));
    }
}
