<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Employee;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Models\TrnMaintenance;
use App\Exports\MaintenanceExportView;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TrnMaintenanceRequest;
use App\Models\SBU;

class TrnMaintenanceController extends Controller
{

    public function index()
    {
        $data = request()->all();
        // $trnMaintenances = TrnMaintenance::select(['trn_desc', 'trn_date'])->where('trn_status', false)->get();
        // return $trnMaintenances;
        if (isSuperadmin())
            $trnMaintenances = TrnMaintenance::search($data)->orderBy('trn_start_date', 'asc')->get();

        else
            $trnMaintenances = TrnMaintenance::search($data)->where('sbu_id', userSBU())->orderBy('trn_start_date', 'asc')->get();

        $maintenances = Maintenance::get();
        $assets = Asset::with('sbu')->orderBy('asset_name', 'asc')->get();
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
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('transaction.maintenance.create', compact(
            'asset',
            'maintenances',
            'employees',
            'SBUs'
        ));
    }

    public function store(TrnMaintenanceRequest $request)
    {
        $data = $this->storeTrnData($request->all());

        if ($request->file('file')) {
            $file = $request->file('file');
            $extension = $file->extension();
            $fileUrl = $file->storeAs('uploads/files/transactions/maintenance', formatTimeDoc($data['trn_no'], $extension));
            $data['file'] = $fileUrl;
        }

        TrnMaintenance::create($data);
        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function storeTrnData($data)
    {

        $date = createDate($data['trn_date']);
        $count = TrnMaintenance::whereMonth('trn_date', $date->month)
            ->whereYear('trn_date', $date->year)
            ->count();

        $data['user_id'] = auth()->user()->id;
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
        $data['transactions'] = request()->all();

        if (isSuperadmin())
            $data['transactions'] =  TrnMaintenance::filter($data['transactions'])->whereNotNull('trn_value')->get();
        else
            $data['transactions'] = TrnMaintenance::filter($data['transactions'])->where('sbu_id', userSBU())->whereNotNull('trn_value')->get();

        $time = now()->format('dmY');
        $name = "ATL-GAN-MAI-{$time}.xlsx";

        $data['total_cost'] = 0;
        $data['total_cost_plan'] = 0;

        foreach ($data['transactions'] as $v) {
            $data['total_cost'] += $v->trn_value;
        }
        foreach ($data['transactions'] as $v) {
            $data['total_cost_plan'] += $v->trn_value_plan;
        }

        // return Excel::download(new MaintenanceExport($data), $name);
        return Excel::download(new MaintenanceExportView($data), $name);
    }

    public function edit(TrnMaintenance $trnMaintenance)
    {
        $maintenances = Maintenance::get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('transaction.maintenance.edit', compact(
            'maintenances',
            'trnMaintenance',
            'employees',
            'SBUs'
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
            $extension = $file->extension();
            $fileUrl = $file->storeAs('uploads/files/transactions/maintenance',  formatTimeDoc($trnMaintenance->trn_no, $extension));
            $data['file'] = $fileUrl;
        } else {
            $data['file'] = $trnMaintenance->file;
        }

        $trnMaintenance->update($data);
        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function destroy(TrnMaintenance $trnMaintenance)
    {
        if ($trnMaintenance->trn_status)
            return redirect()->back()->with('warning', 'Status is <b>CLOSED!</b>');

        Storage::delete($trnMaintenance->file);
        $trnMaintenance->delete();
        return redirect('/trn-maintenance')->with('success', 'Successfully deleted!');
    }

    public function search(Request $request)
    {
        $data = TrnMaintenance::search($request)->orderBy('trn_date', 'desc')->get();
        return $data;
    }

    public function updateStatus(TrnMaintenance $trnMaintenance)
    {
        if (!$trnMaintenance->file)
            return redirect()->back()->with('warning', 'Upload file proven!');

        $trnMaintenance->update([
            'trn_status' => 1
        ]);
        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function updateStatusPlan(TrnMaintenance $trnMaintenance)
    {
        if (!$trnMaintenance->file)
            return redirect()->back()->with('warning', 'Upload file proven!');

        request()->validate([
            'trn_start_date' => 'required',
            'trn_date' => 'required'
        ]);

        $trnMaintenance->update([
            'trn_status' => 1
        ]);

        $data = $this->setPlanData(request()->all(), $trnMaintenance);
        TrnMaintenance::create($data);

        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function setPlanData($request, $trn)
    {
        $date = createDate($request['trn_date']);
        $count = TrnMaintenance::whereMonth('trn_date', $date->month)
            ->whereYear('trn_date', $date->year)
            ->count();
        $no = setNoTrn($request['trn_date'], $count ?? null, 'MAI');

        $trn->trn_no = $no;
        $trn->trn_start_date = $request['trn_start_date'];
        $trn->trn_date  = $request['trn_date'];
        $trn->pemohon  = null;
        $trn->penyetuju  = null;
        $trn->trn_value_plan  = null;
        $trn->trn_value  = null;
        $trn->trn_desc = '<span class="text-info font-weight-bold">(PLAN)</span> ' . $trn->trn_desc;
        $trn->file  = null;

        return $trn->toArray();
    }

    public function download(TrnMaintenance $trnMaintenance)
    {
        $path = public_path() . $trnMaintenance->takeDoc;
        return response()->download($path);
    }
}
