<?php

namespace App\Http\Middleware\Filament;

use App\Events\ShopConfigured;
use App\Listeners\ConfigureShopDefault;
use App\Models\Shop\Shop;
use Closure;
use Filament\Facades\Filament;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigureCurrentShop
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        /** @var Shop $shop */
        $shop = Filament::getTenant();
         /* dd( $shop->appearance->records_per_page->value );*/
        if($shop){
            ShopConfigured::dispatch($shop);
        }

        return $next($request);
    }
}
