<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\bank\BankRepositoryInterface;
use App\Repositories\bank\BankRepository;
use App\Repositories\cart\CartRepositoryInterface;
use App\Repositories\cart\CartRepository;

class BankServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BankRepositoryInterface::class, BankRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
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
