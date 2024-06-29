<?php

/** Set Sidebar item active */

if(!function_exists('setActive')){
    function setActive(array $route){
        if(is_array($route)){
            foreach($route as $r){
                if(request()->routeIs($r)){
                    return 'active show';
                }
            }
        }
    }

}


if (!function_exists('generateInvoiceId')) {
    function generateInvoiceId()
    {
        $date = now()->format('Ymd');

        $uniqueId = \Str::upper(\Str::random(8));
        $invoiceId = "INV-{$date}-{$uniqueId}";

        return $invoiceId;
    }
}


if (!function_exists('currencyPosition')) {
    function currencyPosition($price)
    {
        if (config('settings.site_currency_position') === 'right') {

            return  $price . config('settings.site_currency_symbol');
        } else if (config('settings.site_currency_position') === 'left') {

            return  config('settings.site_currency_symbol') . $price;
        }
    }
}


    if (!function_exists('currencyPositionDemo')) {
    function currencyPositionDemo($price)
    {
        if (true) {

            return  $price . '$';
        } else if (config('settings.site_currency_position') === 'left') {

            return  config('settings.site_currency_symbol') . $price;
        }
    }
}
