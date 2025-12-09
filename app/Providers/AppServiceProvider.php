<?php

namespace App\Providers;

use App\Services\V1\Users\UsersService;
use Illuminate\Support\ServiceProvider;
use App\Services\V1\Users\IUsersService;
use App\Services\V1\Orders\OrdersService;
use App\Services\V1\Orders\IOrdersService;
use App\Services\V1\Payments\PaymentsService;
use App\Repositories\V1\Users\UsersRepository;
use App\Services\V1\Payments\IPaymentsService;
use App\Repositories\V1\Users\IUsersRepository;
use App\Repositories\V1\Orders\OrdersRepository;
use App\Repositories\V1\Orders\IOrdersRepository;
use App\Services\V1\Payments\PaymentGatewayFactory;
use App\Repositories\V1\Payments\PaymentsRepository;
use App\Repositories\V1\Payments\IPaymentsRepository;


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

        $this->app->singleton(PaymentGatewayFactory::class, function ($app) {
            return new PaymentGatewayFactory();
        });
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
        $this->app->bind(IUsersService::class, UsersService::class);
        $this->app->bind(IPaymentsService::class, PaymentsService::class);

    }

    protected function bindRepositories()
    {
        $this->app->bind(IOrdersRepository::class, OrdersRepository::class);
        $this->app->bind(IUsersRepository::class, UsersRepository::class);
        $this->app->bind(IPaymentsRepository::class, PaymentsRepository::class);
    }
}