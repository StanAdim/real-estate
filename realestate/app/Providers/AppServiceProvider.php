<?php

namespace App\Providers;

use App\Services\MessageService;
use App\Services\PropertyService;
use Illuminate\Support\ServiceProvider;
use App\Services\MessageServiceInterface;
use App\Services\PropertyServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PropertyServiceInterface::class, PropertyService::class);
        $this->app->bind(MessageServiceInterface::class, MessageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
