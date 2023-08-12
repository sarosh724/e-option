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
    }
}
