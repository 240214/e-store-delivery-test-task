<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Factories\CourierServiceFactory;
use App\Factories\DeliveryCourierServiceFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CourierServiceFactory::class, DeliveryCourierServiceFactory::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
