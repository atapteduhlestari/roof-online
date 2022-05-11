<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetChild;
use App\Models\AssetGroup;
use App\Models\Calendar as ModelsCalendar;
use App\Models\TrnMaintenance;
use App\Models\TrnRenewal;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public $calendar, $date;

    public function __construct()
    {
        $this->date = Carbon::createFromDate(request()->date);
        $this->calendar = new ModelsCalendar($this->date);
    }

    public function index()
    {
        // $assets = Asset::with([
        //     'trnMaintenance' => fn ($q) => $q->whereDate('trn_date', '<=', $now)
        // ])
        //     ->whereHas('trnMaintenance', fn ($q) => $q->whereDate('trn_date', '<=', $now))
        //     ->get()->sortBy(fn ($q) => $q->trn_date);

        $now = now()->addDays(30)->format('Y-m-d');
        $groups = AssetGroup::get();
        $assets = $this->getAssets($now);
        $docs = $this->getDocs($now);
        $calendar = $this->calendarItems($this->calendar, $assets, $docs);

        return view('index', compact(
            'groups',
            'assets',
            'docs',
            'now',
            'calendar'
        ));
    }

    public function getAssets($time)
    {
        return Asset::join(
            'trn_maintenance',
            fn ($q) => $q->on('asset.id', '=', 'trn_maintenance.asset_id')
                ->whereRaw('trn_maintenance.id IN (select MAX(a2.id) from trn_maintenance as a2 join asset as u2 on u2.id = a2.asset_id group by u2.id)')
                ->whereDate('trn_maintenance.trn_date', '<=', $time)
        )->join('asset_maintenance', 'trn_maintenance.maintenance_id', '=', 'asset_maintenance.id')->get();
    }

    public function getDocs($time)
    {
        return AssetChild::join(
            'trn_renewal',
            fn ($q) => $q->on('asset_child.id', '=', 'trn_renewal.asset_child_id')
                ->whereRaw('trn_renewal.id IN (select MAX(a2.id) from trn_renewal as a2 join asset_child as u2 on u2.id = a2.asset_child_id group by u2.id)')
                ->whereDate('trn_renewal.trn_date', '<=', $time)
        )->join('asset_renewal', 'trn_renewal.renewal_id', '=', 'asset_renewal.id')->get();
    }

    public function calendarItems($calendar, $assets, $docs)
    {
        foreach ($assets as $asset) {
            $calendar->add_event($asset->name, $asset->trn_date);
        }

        foreach ($docs as $doc) {
            $calendar->add_event($doc->name, $doc->trn_date);
        }

        return $calendar;
    }

    public function timeline()
    {
        $trn_maintenance = TrnMaintenance::get();
        $trn_renewal = TrnRenewal::get();
        $calendar = $this->calendar;

        foreach ($trn_maintenance as $m) {
            $calendar->add_event($m->maintenance->name, $m->created_at->format('Y-m-d'));
        }

        foreach ($trn_renewal as $r) {
            $calendar->add_event($r->renewal->name, $r->created_at->format('Y-m-d'));
        }

        return view('timeline', compact('calendar'));
    }

    public function fullCalendar()
    {
        // $data = TrnMaintenance::get();
        // return response()->json([
        //     'title' => $data['title']
        // ]);
    }
}
