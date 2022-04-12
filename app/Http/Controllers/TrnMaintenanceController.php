<?php

namespace App\Http\Controllers;

use App\Models\TrnMaintenance;
use App\Models\Asset;
use App\Models\Employee;
use App\Models\AssetChild;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Requests\TrnMaintenanceRequest;

class TrnMaintenanceController extends Controller
{

    public function index()
    {
        $trnMaintenances = TrnMaintenance::get();
        $maintenances = Maintenance::get();
        $assets = Asset::orderBy('asset_name', 'asc')->get();
        $assetChild = AssetChild::orderBy('name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('transaction.maintenance.index', compact(
            'trnMaintenances',
            'maintenances',
            'assets',
            'assetChild',
            'employees'
        ));
    }

    public function create()
    {
        //
    }

    public function store(TrnMaintenanceRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        if ($request->check == 0) {
            $data['asset_child_id'] = $data['asset_id'];
            unset($data['asset_id']);
        }

        $date = createDate($data['trn_date']);
        $count = TrnMaintenance::whereMonth('trn_date', $date->month)
            ->whereYear('trn_date', $date->year)
            ->count();

        $data['trn_no'] = setNoTrn($data['trn_date'], $count ?? null, 'MAI');
        TrnMaintenance::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function show(TrnMaintenance $trnMaintenance)
    {
        //
    }

    public function edit(TrnMaintenance $trnMaintenance)
    {
        $trnMaintenances = TrnMaintenance::get();
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('transaction.maintenance.edit', compact(
            'trnMaintenance',
            'trnMaintenances',
            'employees'
        ));
    }

    public function update(TrnMaintenanceRequest $request, TrnMaintenance $trnMaintenance)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['maintenance_id'] = $trnMaintenance->maintenance_id;
        $data['asset_id'] = $trnMaintenance->assets()->exists() ? $trnMaintenance->asset_id : null;
        $data['asset_child_id'] = $trnMaintenance->assetChildren()->exists() ? $trnMaintenance->asset_child_id : null;

        $trnMaintenance->update($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(TrnMaintenance $trnMaintenance)
    {
        $trnMaintenance->delete();
        return redirect('/trn-maintenance')->with('success', 'Success!');
    }
}
