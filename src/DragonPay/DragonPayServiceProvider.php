<?php

namespace DragonPay;

use Illuminate\Support\ServiceProvider;

class DragonPayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/../../views', 'DragonPay');

        $this->publishes([
            __DIR__.'/../../assets' => public_path('vendor/DragonPay'),
        ], 'public');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('dragonpay', function() {
            return new DragonPay(null);
        });
    }
}