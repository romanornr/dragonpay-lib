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

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('dragonpay', function() {
            return new DragonPay();
        });
    }
}