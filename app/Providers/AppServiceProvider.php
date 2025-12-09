<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Api\V1\Users\Services\UsersService;
use App\Api\V1\Users\Services\IUsersService;
use App\Api\V1\Orders\Services\OrdersService;
use App\Api\V1\Orders\Services\IOrdersService;
use App\Api\V1\Payments\Services\PaymentsService;
use App\Api\V1\Payments\Services\IPaymentsService;
use App\Api\V1\Users\Repositories\UsersRepository;
use App\Api\V1\Base\Payments\PaymentGatewayFactory;
use App\Api\V1\Users\Repositories\IUsersRepository;
use App\Api\V1\Orders\Repositories\OrdersRepository;
use App\Api\V1\Orders\Repositories\IOrdersRepository;
use App\Api\V1\Payments\Repositories\PaymentsRepository;
use App\Api\V1\Payments\Repositories\IPaymentsRepository;



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