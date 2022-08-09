<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Employee;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Models\TrnMaintenance;
use App\Exports\MaintenanceExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TrnMaintenanceRequest;
use App\Models\SBU;

class TrnMaintenanceController extends Controller
{

    public function index()
    {
        $data = request()->all();

        if (isSuperadmin())
            $trnMaintenances = TrnMaintenance::search($data)->get();

        else
            $trnMaintenances = TrnMaintenance::search($data)->where('sbu_id', userSBU())->get();

        $maintenances = Maintenance::get();
        $assets = Asset::orderBy('asset_name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('transaction.maintenance.index', compact(
            'trnMaintenances',
            'maintenances',
            'assets',
            'employees',
            'SBUs'
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

        if ($request->file('file')) {
            $file = $request->file('file');
            $fileUrl = $file->storeAs('uploads/files/transactions/maintenance',  $file->hashName());
            $data['file'] = $fileUrl;
        }

        TrnMaintenance::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function storeTrnData($data)
    {

        $date = createDate($data['trn_date']);
        $count = TrnMaintenance::whereMonth('trn_date', $date->month)
            ->whereYear('trn_date', $date->year)
            ->count();

        $data['user_id'] = auth()->user()->id;
        $data['sbu_id'] = Asset::firstWhere('id', $data['asset_id'])->sbu_id;
        $data['trn_value_plan'] = removeDots($data['trn_value_plan']);
        $data['trn_value'] = removeDots($data['trn_value']);
        $data['trn_no'] = setNoTrn($data['trn_date'], $count ?? null, 'MAI');

        return $data;
    }

    public function show(TrnMaintenance $trnMaintenance)
    {
        if (isSuperadmin() || $trnMaintenance->sbu_id == userSBU())
            return view('transaction.maintenance.show', compact('trnMaintenance'));
        else
            return redirect()->back()->with('warning', 'Access Denied!');
    }

    public function export()
    {
        $data = request()->all();

        if (isSuperadmin())
            $data =  TrnMaintenance::filter($data)->get();
        else
            $data = TrnMaintenance::filter($data)->where('sbu_id', userSBU())->get();

        $time = now()->format('dmY');
        $name = "ATL-GAN-MAI-{$time}.xlsx";

        return Excel::download(new MaintenanceExport($data), $name);
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
        $data['trn_value_plan'] = removeDots($data['trn_value_plan']);
        $data['trn_value'] = removeDots($data['trn_value']);

        if ($request->file('file')) {
            Storage::delete($trnMaintenance->file);
            $file = $request->file('file');
            $fileUrl = $file->storeAs('uploads/files/transactions/maintenance',  $file->hashName());
            $data['file'] = $fileUrl;
        } else {
            $data['file'] = $trnMaintenance->file;
        }

        $trnMaintenance->update($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(TrnMaintenance $trnMaintenance)
    {
        Storage::delete($trnMaintenance->file);
        $trnMaintenance->delete();
        return redirect('/trn-maintenance')->with('success', 'Success!');
    }

    public function search(Request $request)
    {
        $data = TrnMaintenance::search($request)->orderBy('trn_date', 'desc')->get();
        return $data;
    }

    public function updateStatus(TrnMaintenance $trnMaintenance)
    {
        if ($trnMaintenance->file == 2)
            return redirect()->back()->with('warning', 'Upload a file to proof!');

        $trnMaintenance->update([
            'trn_status' => 1
        ]);
        return redirect()->back()->with('success', 'Success!');
    }

    public function download(TrnMaintenance $trnMaintenance)
    {
        $path = public_path() . $trnMaintenance->takeDoc;
        return response()->download($path);
    }
}
