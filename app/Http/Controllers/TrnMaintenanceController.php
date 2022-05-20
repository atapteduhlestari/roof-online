<?php

namespace App\Http\Controllers;

use App\Models\TrnMaintenance;
use App\Models\Asset;
use App\Models\Employee;
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
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('transaction.maintenance.index', compact(
            'trnMaintenances',
            'maintenances',
            'assets',
            'employees'
        ));
    }

    public function create(Request $request)
    {
        $maintenances = Maintenance::orderBy('name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $asset = Asset::findOrFail($request->id);

        return view('transaction.maintenance.create', compact(
            'asset',
            'maintenances',
            'employees'
        ));
    }

    public function store(TrnMaintenanceRequest $request)
    {;

        $data = $this->storeTrnData($request->all());
        TrnMaintenance::create($data);

        TrnMaintenance::where('asset_id', $data['asset_id'])
            ->where('maintenance_id',  $data['maintenance_id'])
            ->latest()->first()
            ->update([
                'trn_status' => 1
            ]);

        return redirect()->back()->with('success', 'Success!');
    }

    public function storeTrnData($data)
    {

        $date = createDate($data['trn_date']);
        $count = TrnMaintenance::whereMonth('trn_date', $date->month)
            ->whereYear('trn_date', $date->year)
            ->count();

        $data['user_id'] = auth()->user()->id;
        $data['trn_value'] = removeDots($data['trn_value']);
        $data['trn_no'] = setNoTrn($data['trn_date'], $count ?? null, 'MAI');

        return $data;
    }

    public function show(TrnMaintenance $trnMaintenance)
    {
        return view('transaction.maintenance.show', compact('trnMaintenance'));
    }

    public function edit(TrnMaintenance $trnMaintenance)
    {
        $maintenances = Maintenance::get();
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('transaction.maintenance.edit', compact(
            'maintenances',
            'trnMaintenance',
            'employees'
        ));
    }

    public function update(TrnMaintenanceRequest $request, TrnMaintenance $trnMaintenance)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['trn_value'] = removeDots($data['trn_value']);

        $trnMaintenance->update($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(TrnMaintenance $trnMaintenance)
    {
        $trnMaintenance->delete();
        return redirect('/trn-maintenance')->with('success', 'Success!');
    }
}
