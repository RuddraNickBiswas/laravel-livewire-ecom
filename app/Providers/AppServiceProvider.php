<?php

namespace App\Providers;

use BezhanSalleh\PanelSwitch\PanelSwitch;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

        // Gate::guessPolicyNamesUsing(function (string $modelClass) {
        //     // Get the base name of the model class without the namespace
        //     $modelBaseName = class_basename($modelClass);

        //     // Determine the policy class namespace
        //     $policyNamespace = 'App\\Policies\\';

        //     // Handle models in subdirectories by appending the subdirectory to the policy namespace
        //     if (Str::contains($modelClass, 'Models\\')) {
        //         $subDirectory = Str::between($modelClass, 'Models\\', '\\' . $modelBaseName);
        //         if (!empty($subDirectory)) {
        //             $policyNamespace .= str_replace('\\', '\\\\', $subDirectory) . '\\';
        //         }
        //     }

        //     // Construct the full policy class name
        //     $policyClassName = $policyNamespace . $modelBaseName . 'Policy';

        //     return $policyClassName;
        // });

        Gate::guessPolicyNamesUsing(function (string $modelClass) {
            // Replace 'Models' with 'Policies' in the model's namespace and append 'Policy' to the class name
            $targetPolicy = str_replace('Models', 'Policies', $modelClass) . 'Policy';

            // Return the target policy class if it exists, otherwise return null
            return class_exists($targetPolicy) ? $targetPolicy : null;
        });

        PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
            $panelSwitch->icons([
                'admin' => 'heroicon-o-shield-check',
                'shop' => 'heroicon-o-shopping-bag',
            ], $asImage = false)
            ->visible(fn (): bool => auth()->user()?->hasAnyRole([
                'super_admin',
            ]));;
        });
        // FilamentView::registerRenderHook(
        //     PanelsRenderHook::SCRIPTS_AFTER,
        //     fn (): string => new HtmlString('
        // <script>document.addEventListener("scroll-to-top", () => window.scrollTo(0, 0))</script>
        //     '),
        // );


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
