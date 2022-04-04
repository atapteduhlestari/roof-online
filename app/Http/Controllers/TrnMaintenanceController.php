<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Employee;
use App\Models\AssetChild;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Models\TrnMaintenance;

class TrnMaintenanceController extends Controller
{

    public function index()
    {
        $trnMaintenances = TrnMaintenance::get();
        $maintenances = Maintenance::get();
        $assets = Asset::get();
        $assetChild = AssetChild::get();
        $employees = Employee::get();
        return view('transaction.maintenance.index', compact('trnMaintenances', 'maintenances', 'assets', 'assetChild', 'employees'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'trn_no' => 'required',
            'trn_date' => 'required',
            'asset_id' => 'required',
            'maintenance_id' => 'required',
            'pelaksana' => 'required',
            'penyetuju' => 'required',
            'check' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        if ($request->check == 0) {
            $data['asset_child_id'] = $data['asset_id'];
            unset($data['asset_id']);
        }

        TrnMaintenance::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function show(TrnMaintenance $trnMaintenance)
    {
        //
    }

    public function edit(TrnMaintenance $trnMaintenance)
    {
        //
    }

    public function update(Request $request, TrnMaintenance $trnMaintenance)
    {
        //
    }

    public function destroy(TrnMaintenance $trnMaintenance)
    {
        //
    }
}
