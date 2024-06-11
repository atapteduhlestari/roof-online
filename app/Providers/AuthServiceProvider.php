<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Models\Asset' => 'App\Policies\AssetPolicy',
        'App\Models\AssetChild' => 'App\Policies\AssetChildPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
