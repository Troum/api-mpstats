<?php

namespace App\Providers;

use App\Services\MpstatsService;
use Illuminate\Support\ServiceProvider;

class MpstatsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MpstatsService::class, function ($app) {
            return new MpstatsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
