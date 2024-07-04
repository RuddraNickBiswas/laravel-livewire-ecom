<?php

namespace App\Listeners;

use App\Enums\Setting\Font;
use App\Enums\Setting\PrimaryColor;
use App\Events\ShopConfigured;
use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ConfigureShopDefault
{

    public function handle(ShopConfigured $event): void
    {
        $shop = $event->shop;

        $defaultPrimaryColor = $shop->appearance->primary_color ?? PrimaryColor::from(PrimaryColor::DEFAULT);
        $defaultGrayColor = $shop->appearance->gray_color ?? PrimaryColor::from(PrimaryColor::DEFAULT);
        $defaultFont = $shop->appearance->font->value ?? Font::DEFAULT;



        FilamentColor::register([
            'primary' => $defaultPrimaryColor->getColor(),
            'gray' => $defaultPrimaryColor->getColor(),
        ]);


        Filament::getCurrentPanel()
            ->font($defaultFont);
    }
}
