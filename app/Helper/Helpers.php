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
