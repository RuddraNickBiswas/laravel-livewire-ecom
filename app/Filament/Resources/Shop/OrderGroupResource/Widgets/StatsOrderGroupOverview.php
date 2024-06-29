<?php

namespace App\Filament\Resources\Shop\OrderGroupResource\Widgets;

use App\Enums\PaymentStatus;
use App\Filament\Resources\Shop\OrderGroupResource\Pages\ListOrderGroups;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOrderGroupOverview extends BaseWidget
{
    use InteractsWithPageTable;


    protected static ?string $pollingInterval = null;


    protected function getTablePage(): string
    {
        return ListOrderGroups::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Users Total Order', $this->getPageTableQuery()->count())
                ->chart([5, 10, 20, 15, 25, 30, 35]),
            Stat::make('Paid', $this->getPageTableQuery()->where('payment_status', PaymentStatus::Completed)->count())
                ->chart([5,10,20,10,30]),
            Stat::make('Total Paid Amount', number_format($this->getPageTableQuery()->where('payment_status', PaymentStatus::Completed)->sum('total_price'), 2))
                ->chart([5,15,25,10,30,25,35,40]),
        ];
    }
}
