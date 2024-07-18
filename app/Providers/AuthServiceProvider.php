<?php

namespace App\Providers;

use App\Models\Asset;
use App\Models\TrnRenewal;
use App\Policies\AssetPolicy;
use App\Models\TrnMaintenance;
use App\Policies\TrnRenewalPolicy;
use App\Policies\TrnMaintenancePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Asset::class => AssetPolicy::class,
        TrnMaintenance::class => TrnMaintenancePolicy::class,
        TrnRenewal::class => TrnRenewalPolicy::class,
        Asset::class => AssetPolicy::class,
        'App\Models\AssetChild' => 'App\Policies\AssetChildPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
