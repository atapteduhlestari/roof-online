<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale('en');
        date_default_timezone_set('Asia/Jakarta');

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }

    public function boot()
    {
        //
    }
}
