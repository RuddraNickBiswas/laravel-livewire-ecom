<?php

namespace App\Listeners;

use App\Enums\Setting\Font;
use App\Enums\Setting\PrimaryColor;
use App\Enums\Setting\RecordsPerPage;
use App\Enums\Setting\TableSortDirection;
use App\Events\ShopConfigured;
use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentColor;
use Filament\Tables\Table;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ConfigureShopDefault
{

    public function handle(ShopConfigured $event): void
    {
        $shop = $event->shop;
        $paginationPageOptions = RecordsPerPage::caseValues();
        $defaultPaginationPageOption = $shop->appearance->records_per_page->value ?? RecordsPerPage::DEFAULT;
        $defaultSort = $shop->appearance->table_sort_direction->value ?? TableSortDirection::DEFAULT;
        $defaultPrimaryColor = $shop->appearance->primary_color ?? PrimaryColor::from(PrimaryColor::DEFAULT);
        $defaultBgColor = $shop->appearance->bg_color ?? PrimaryColor::from(PrimaryColor::DEFAULT);
        $defaultFont = $shop->appearance->font->value ?? Font::DEFAULT;


        Table::configureUsing(static function (Table $table) use ($paginationPageOptions, $defaultSort, $defaultPaginationPageOption): void {

            $table
                ->paginationPageOptions($paginationPageOptions)
                ->defaultSort(column: 'id', direction: $defaultSort)
                ->defaultPaginationPageOption($defaultPaginationPageOption);
        }, isImportant: true);

        FilamentColor::register([
            'primary' => $defaultPrimaryColor->getColor(),
            'gray' => $defaultBgColor->getColor(),
        ]);


        Filament::getCurrentPanel()
            ->font($defaultFont);
    }
}
