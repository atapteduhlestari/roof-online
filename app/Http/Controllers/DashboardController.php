<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetChild;
use App\Models\AssetGroup;
use App\Models\Calendar as ModelsCalendar;
use App\Models\TrnMaintenance;


class DashboardController extends Controller
{
    public function index()
    {
        $now = now()->addDays(30)->format('Y-m-d');

        $assets = Asset::join(
            'trn_maintenance',
            fn ($q) => $q->on('asset.id', '=', 'trn_maintenance.asset_id')
                ->whereRaw('trn_maintenance.id IN (select MAX(a2.id) from trn_maintenance as a2 join asset as u2 on u2.id = a2.asset_id group by u2.id)')
                ->whereDate('trn_maintenance.trn_date', '<=', $now)
        )->join('asset_maintenance', 'trn_maintenance.maintenance_id', '=', 'asset_maintenance.id')->get();

        // $assets = Asset::with([
        //     'trnMaintenance' => fn ($q) => $q->whereDate('trn_date', '<=', $now)
        // ])
        //     ->whereHas('trnMaintenance', fn ($q) => $q->whereDate('trn_date', '<=', $now))
        //     ->get()->sortBy(fn ($q) => $q->trn_date);

        $docs = AssetChild::join(
            'trn_renewal',
            fn ($q) => $q->on('asset_child.id', '=', 'trn_renewal.asset_child_id')
                ->whereRaw('trn_renewal.id IN (select MAX(a2.id) from trn_renewal as a2 join asset_child as u2 on u2.id = a2.asset_child_id group by u2.id)')
                ->whereDate('trn_renewal.trn_date', '<=', $now)
        )->join('asset_renewal', 'trn_renewal.renewal_id', '=', 'asset_renewal.id')->get();

        $calendar = new ModelsCalendar();
        foreach ($assets as $asset) {
            $calendar->add_event($asset->name, $asset->trn_date);
        }

        $groups = AssetGroup::get();
        return view('index', compact(
            'groups',
            'assets',
            'docs',
            'now',
            'calendar'
        ));
    }

    public function fullCalendar()
    {
        // $data = TrnMaintenance::get();
        // return response()->json([
        //     'title' => $data['title']
        // ]);
    }
}
