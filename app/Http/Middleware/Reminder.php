<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Asset;
use App\Models\AssetChild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Reminder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $now = now()->addDays(30)->format('Y-m-d');

        if (isSuperadmin()) {
            $assets = Asset::getAllLastTransaction($now)->where('trn_status', false)->get();
            $docs = AssetChild::getAllLastTransaction($now)->where('trn_status', false)->get();
        } else {
            $assets = Asset::getLastTransaction($now)->where('trn_status', false)->get();
            $docs = AssetChild::getLastTransaction($now)->where('trn_status', false)->get();
        }


        $alerts = FillAlertsData($assets, $docs);

        View::share('alerts', $alerts);
        return $next($request);
    }

    public function checkUser()
    {
    }
}
