<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\AssetChild;
use App\Models\AssetGroup;
use App\Models\TrnRenewal;
use App\Models\TrnMaintenance;
use App\Models\Calendar as ModelsCalendar;

class DashboardController extends Controller
{
    public $calendar, $date, $now, $reqDays;

    public function __construct()
    {
        $this->reqDays = request()->days ?? 30;
        $this->now = now()->addDays($this->reqDays)->format('Y-m-d');
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

        $groups = AssetGroup::get();
        return view('index', compact('groups'));
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

        if (isSuperadmin()) {
            $assets = Asset::getAllLastTransaction($this->now)->where('trn_status', false)->get()->sortByDesc('trn_start_date');
            $docs = AssetChild::getAllLastTransaction($this->now)->where('trn_status', false)->get()->sortByDesc('trn_start_date');
        } else {
            $assets = Asset::getLastTransaction($this->now)->where('trn_status', false)->get()->sortByDesc('trn_start_date');
            $docs = AssetChild::getLastTransaction($this->now)->where('trn_status', false)->get()->sortByDesc('trn_start_date');
        }

        $data = timelineReminders($assets, $docs)->sortBy('trn_start_date')->reverse();

        if (isSuperadmin()) {
            $trn_maintenance = TrnMaintenance::get();
            $trn_renewal = TrnRenewal::get();
        } else {
            $trn_maintenance = TrnMaintenance::where('sbu_id', userSBU())->get();
            $trn_renewal = TrnRenewal::where('sbu_id', userSBU())->get();
        }

        $calendar = $this->timelineCalendar($this->calendar, $trn_maintenance, $trn_renewal);
        return view('timeline', compact('calendar', 'data'));
    }

    public function timelineCalendar($calendar, $trn_maintenance, $trn_renewal)
    {
        foreach ($trn_maintenance as $m) {
            $calendar->add_event(
                $m->maintenance->name,
                $m->trn_start_date,
                1,
                "/trn-maintenance/{$m->id}",
                $m->trn_status ? "bg-primary" : '',
            );
        }

        foreach ($trn_renewal as $r) {
            $calendar->add_event(
                $r->renewal->name,
                $r->trn_start_date,
                1,
                "/trn-renewal/{$r->id}",
                $r->trn_status ? "bg-primary" : '',
            );
        }

        return $calendar;
    }
}
