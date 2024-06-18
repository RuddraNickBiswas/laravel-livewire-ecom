<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        FilamentView::registerRenderHook(
            PanelsRenderHook::SCRIPTS_AFTER,
            fn (): string => new HtmlString('
        <script>document.addEventListener("scroll-to-top", () => window.scrollTo(0, 0))</script>
            '),
        );
        // Blade::component('auth.input', 'input');
        // Blade::component('auth.label', 'label');
        // Blade::component('auth.button', 'button');
        // Blade::component('auth.secondary-button', 'secondary-button');
        // Blade::component('auth.danger-button', 'danger-button');
        // Blade::component('auth.action-message', 'action-message');
        // Blade::component('auth.form-section', 'form-section');
        // Blade::component('auth.action-section', 'action-section');
        // Blade::component('auth.dialog-modal', 'dialog-modal');
        // Blade::component('auth.confirms-password', 'confirms-password');
    }
}
