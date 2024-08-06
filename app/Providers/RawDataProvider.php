<?php

namespace App\Providers;

use App\Interfaces\RawDataInterface;
use App\Service\RawDataService;
use Illuminate\Support\ServiceProvider;

class RawDataProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RawDataInterface::class, RawDataService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
