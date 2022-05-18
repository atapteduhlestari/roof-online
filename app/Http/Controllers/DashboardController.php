<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\AssetChild;
use App\Models\AssetGroup;
use App\Models\TrnRenewal;
use App\Models\TrnMaintenance;
use Illuminate\Support\Facades\DB;
use App\Models\Calendar as ModelsCalendar;

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
        $assets =  Asset::getLastTransaction($now);
        $docs = AssetChild::getLastTransaction($now);
        $calendar = $this->calendarItems($this->calendar, $assets, $docs);


        return view('index', compact(
            'groups',
            'assets',
            'docs',
            'now',
            'calendar'
        ));
    }

    public function calendarItems($calendar, $assets, $docs)
    {
        foreach ($assets as $asset) {
            $calendar->add_event(
                $asset->name,
                $asset->trn_date,
                1,
            );
        }

        foreach ($docs as $doc) {
            $calendar->add_event(
                $doc->name,
                $doc->trn_date,
                1,
            );
        }

        return $calendar;
    }

    public function timeline()
    {
        $trn_maintenance = TrnMaintenance::get();
        $trn_renewal = TrnRenewal::get();
        $calendar = $this->calendar;

        foreach ($trn_maintenance as $m) {
            $calendar->add_event(
                $m->maintenance->name,
                $m->trn_start_date,
                1,
                "/trn-maintenance/{$m->id}",
            );
        }

        foreach ($trn_renewal as $r) {
            $calendar->add_event(
                $r->renewal->name,
                $r->trn_start_date,
                1,
                "/trn-renewal/{$r->id}",
            );
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
