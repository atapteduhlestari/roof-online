<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $assets, $docs, $alerts;

    public function register()
    {
    }

    public function boot()
    {

        ini_set('post_max_size ', '2048M');
        ini_set('upload_max_size', '2048M');
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time ', '30');

        Schema::defaultStringLength(191);
        Carbon::setLocale('en');
        date_default_timezone_set('Asia/Jakarta');

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Gate::define('superadmin', function (User $user) {
            return $user->is_admin == 1;
        });

        Gate::define('admin', function (User $user) {
            return $user->is_admin == 2;
        });
    }
}
