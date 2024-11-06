<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        /*$providers = require base_path('bootstrap/providers.php');
        foreach ($providers as $provider) {
            $this->app->register($provider);
        }*/
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Carbon::setLocale(LC_TIME);
        Schema::defaultStringLength(191);

        Blade::component('components.button.navigation', 'button-navigation');
        Blade::component('components.button', 'button');

        // Register Jetstream components (if necessary)
        Blade::component('jetstream::components.application-mark', 'jet-application-mark');
        Blade::component('jetstream::components.dropdown-link', 'jet-dropdown-link');
        Blade::component('jetstream::components.dropdown', 'jet-dropdown');

        // Register Tall Toasts components (assuming it's the correct namespace)
        Blade::component('vendor.tall-toasts.livewire.toasts', 'tall-toasts-livewire-toasts');
        Blade::component('vendor.tall-toasts.includes.content', 'tall-toasts-includes-content');
        Blade::component('vendor.tall-toasts.includes.icon', 'tall-toasts-includes-icon');
    }
}
