<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\V1\Orders\OrdersService;
use App\Services\V1\Orders\IOrdersService;
use App\Repositories\V1\Orders\OrdersRepository;
use App\Repositories\V1\Orders\IOrdersRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //services bind
        $this->bindServices();

        // repository bind
        $this->bindRepositories();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    protected function bindServices()
    {
        $this->app->bind(IOrdersService::class, OrdersService::class);
    }

    protected function bindRepositories()
    {
        $this->app->bind(IOrdersRepository::class, OrdersRepository::class);
    }
}
