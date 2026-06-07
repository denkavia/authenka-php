<?php

namespace Denkavia\Authenka\Providers;

use Denkavia\Authenka\Authenka;
use Illuminate\Support\ServiceProvider;

class AuthenkaLaravelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/authenka.php', 'authenka');

        $this->app->singleton('authenka', function () {
            $drivers = [];

            return new Authenka(
                config('authenka'),
                $drivers
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                'config/authenka.php' => config_path('authenka.php'),
            ], 'authenka-config');
        }
    }
}