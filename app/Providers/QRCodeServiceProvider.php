<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BaconQrCode\Encoder\QrCode;

class QRCodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('QrCode', function ($app) {
            return new QrCode();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
