<?php

namespace App\Providers\Filament;

use App\Filament\Shop\Pages\Tenancy\EditShopProfile;
use App\Filament\Shop\Pages\Tenancy\RegisterShop;
use App\Http\Middleware\Filament\ConfigureCurrentShop;
use App\Models\Setting\Appearance;
use App\Models\Shop\Shop;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ShopPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        // $appearance =  Appearance::whereBelongsTo(Filament::getTenant());
        return $panel
            ->id('shop')
            ->path('shop')
            ->login()

            ->font('Inter')
            ->discoverResources(in: app_path('Filament/Shop/Resources'), for: 'App\\Filament\\Shop\\Resources')
            ->discoverPages(in: app_path('Filament/Shop/Pages'), for: 'App\\Filament\\Shop\\Pages')
            ->pages([
                \App\Filament\Shop\Pages\Dashboard::class,
            ])
            ->discoverClusters(in: app_path('Filament/Shop/Clusters'), for: 'App\\Filament\\Shop\\Clusters')
            ->discoverWidgets(in: app_path('Filament/Shop/Widgets'), for: 'App\\Filament\\Shop\\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,


            ])
            ->authMiddleware([
                Authenticate::class,
            ])->tenant(Shop::class, ownershipRelationship: "shop", slugAttribute: 'slug')
            ->tenantRegistration(RegisterShop::class)
            ->tenantProfile(EditShopProfile::class)
            ->tenantMiddleware([
                ConfigureCurrentShop::class,
            ])
            ->viteTheme('resources/css/filament/shop/theme.css')
            ->plugins([]);
    }
}
