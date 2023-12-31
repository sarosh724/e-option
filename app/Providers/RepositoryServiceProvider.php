<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\SiteInterface',
            'App\Repositories\SiteRepository'
        );

        $this->app->bind(
            'App\Interfaces\WithdrawalInterface',
            'App\Repositories\WithdrawalRepository'
        );

        $this->app->bind(
            'App\Interfaces\CoinInterface',
            'App\Repositories\CoinRepository'
        );

        $this->app->bind(
            'App\Interfaces\PaymentMethodInterface',
            'App\Repositories\PaymentMethodRepository'
        );

        $this->app->bind(
            'App\Interfaces\DepositInterface',
            'App\Repositories\DepositRepository'
        );

        $this->app->bind(
            'App\Interfaces\SettingInterface',
            'App\Repositories\SettingRepository'
        );

        $this->app->bind(
            'App\Interfaces\UserInterface',
            'App\Repositories\UserRepository'
        );

        $this->app->bind(
            'App\Interfaces\DashboardInterface',
            'App\Repositories\DashboardRepository'
        );
    }
}
