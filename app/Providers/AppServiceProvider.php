<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        $christmas = '2023-08-15';
        $christmas = Carbon::create($christmas);
        $now = now();
        $tes =  $christmas->diff($now)->format('%y years, %m months and %d days');


        View::share('tes', $tes);
    }

    public function boot()
    {
        //
    }
}
