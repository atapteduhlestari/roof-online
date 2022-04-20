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
        $assetChild = AssetChild::orderBy('doc_name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('transaction.maintenance.index', compact(
            'trnMaintenances',
            'maintenances',
            'assets',
            'assetChild',
            'employees'
        ));
    }

    public function create(Request $request)
    {
        $check = $request->check;
        $maintenances = Maintenance::orderBy('name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $assets = null;

        switch ($check) {
            case 'document':
                $asset = AssetChild::find($request->id);
                return view('transaction.maintenance.docs.create', compact('asset', 'maintenances', 'employees'));
                break;

            case 'asset':
                $asset = Asset::find($request->id);
                return view('transaction.maintenance.create', compact('asset', 'maintenances', 'employees'));
                break;

            default:
                return redirect()->back()->with('warning', 'Oops something wrong, try again!');
                break;
        }
    }

    public function store(TrnMaintenanceRequest $request)
    {
        $data = $request->all();

        if ($data['check'] == 0) {
            $data['asset_child_id'] = $data['asset_id'];
            unset($data['asset_id']);
        }

        $this->storeTrnData($data);
        TrnMaintenance::create($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function storeAsset(Request $request)
    {
        $request->validate([
            'trn_date' => 'required|date',
            'asset_id' => 'required',
            'maintenance_id' => 'required',
            'pemohon' => 'required',
            'penyetuju' => 'required',
        ]);

        $data = $request->all();
        $this->storeTrnData($data);

        return redirect()->back()->with('success', 'Success!');
    }


    public function storeDoc(Request $request)
    {
        $request->validate([
            'trn_date' => 'required|date',
            'asset_child_id' => 'required',
            'maintenance_id' => 'required',
            'pemohon' => 'required',
            'penyetuju' => 'required',
        ]);

        $data = $request->all();
        $this->storeTrnData($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function storeTrnData($data)
    {
        $data['user_id'] = auth()->user()->id;
        $date = createDate($data['trn_date']);
        $count = TrnMaintenance::whereMonth('trn_date', $date->month)
            ->whereYear('trn_date', $date->year)
            ->count();
        $data['trn_no'] = setNoTrn($data['trn_date'], $count ?? null, 'MAI');

        TrnMaintenance::create($data);
        return;
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
