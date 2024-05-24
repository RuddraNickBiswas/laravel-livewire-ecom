<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
