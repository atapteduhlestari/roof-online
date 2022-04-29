<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetGroup;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $assets = Asset::whereHas('trnMaintenance', function ($q) {
            return $q->whereDate('trn_date', '<=',  now()->addDays(30)->format('Y-m-d'));
        })->get()->sortBy(function ($q) {
            return $q->trn_date;
        });


        $groups = AssetGroup::get();

        return view('index', compact('groups', 'assets'));
    }
}
