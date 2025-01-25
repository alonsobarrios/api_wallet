<?php

namespace App\Providers;

use App\Integration\IntegrationProvider;
use App\Integration\SOAP\WalletSoapIntegrationProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(IntegrationProvider::class, function () {
            return new WalletSoapIntegrationProvider();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
