<?php

namespace App\Http\Controllers;

use App\Models\SBU;
use App\Models\Renewal;
use App\Models\Employee;
use App\Models\AssetChild;
use App\Models\TrnRenewal;
use Illuminate\Http\Request;
use App\Exports\RenewalExportView;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TrnRenewalRequest;

class TrnRenewalController extends Controller
{
    public function index()
    {
        $data = request()->all();
        // return $trnRenewals = TrnRenewal::where('trn_status', $data['status'])->get();
        if (isSuperadmin())
            $trnRenewals = TrnRenewal::search($data)->orderBy('trn_start_date', 'asc')->get();
        else
            $trnRenewals = TrnRenewal::search($data)->where('sbu_id', userSBU())->orderBy('trn_start_date', 'asc')->get();

        // return $trnRenewals;
        $renewals = Renewal::get();
        $assetChild = AssetChild::orderBy('doc_name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('transaction.renewal.index', compact(
            'trnRenewals',
            'renewals',
            'assetChild',
            'employees',
            'SBUs'
        ));
    }

    public function create(Request $request)
    {
        $renewals = Renewal::orderBy('name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $assetChild = AssetChild::findOrFail($request->id);
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('transaction.renewal.create', compact(
            'assetChild',
            'renewals',
            'employees',
            'SBUs'
        ));
    }

    public function store(TrnRenewalRequest $request)
    {
        $data = $this->storeTrnData($request->all());

        if ($request->file('file')) {
            $file = $request->file('file');
            $extension = $file->extension();
            $fileUrl = $file->storeAs('uploads/files/transactions/renewal', formatTimeDoc($data['trn_no'], $extension));
            $data['file'] = $fileUrl;
        }

        TrnRenewal::create($data);
        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function storeTrnData($data)
    {
        $date = createDate($data['trn_date']);
        $count = TrnRenewal::whereMonth('trn_date', $date->month)
            ->whereYear('trn_date', $date->year)
            ->count();

        $data['user_id'] = auth()->user()->id;
        $data['trn_no'] = setNoTrn($data['trn_date'], $count ?? null, 'REN');
        $data['trn_value_plan'] = removeDots($data['trn_value_plan']);
        $data['trn_value'] = removeDots($data['trn_value']);

        return $data;
    }

    public function show(TrnRenewal $trnRenewal)
    {
        if (isSuperadmin() || $trnRenewal->sbu_id == userSBU())
            return view('transaction.renewal.show', compact('trnRenewal'));
        else
            return redirect()->back()->with('warning', 'Access Denied!');
    }

    public function export()
    {
        $data['transactions'] = request()->all();

        if (isSuperadmin())
            $data['transactions'] =  TrnRenewal::filter($data['transactions'])->get();
        else
            $data['transactions'] = TrnRenewal::filter($data['transactions'])->where('sbu_id', userSBU())->get();

        $time = now()->format('dmY');
        $name = "ATL-GAN-REN-{$time}.xlsx";

        // $cost = $data['transactions']->sum(function ($val) {
        //     return $val->sum('trn_value');
        // });

        // $cost_plan = $data['transactions']->sum(function ($val) {
        //     return $val->sum('trn_value_plan');
        // });

        $data['total_cost'] = 0;
        $data['total_cost_plan'] = 0;

        foreach ($data['transactions'] as $v) {
            $data['total_cost'] += $v->trn_value;
        }
        foreach ($data['transactions'] as $v) {
            $data['total_cost_plan'] += $v->trn_value_plan;
        }

        // return Excel::download(new RenewalExport($data), $name);
        return Excel::download(new RenewalExportView($data), $name);
    }

    public function edit(TrnRenewal $trnRenewal)
    {
        $renewals = Renewal::get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('transaction.renewal.edit', compact(
            'trnRenewal',
            'renewals',
            'employees',
            'SBUs'
        ));
    }

    public function update(TrnRenewalRequest $request, TrnRenewal $trnRenewal)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['trn_value_plan'] = removeDots($data['trn_value_plan']);
        $data['trn_value'] = removeDots($data['trn_value']);
        $data['renewal_id'] = $trnRenewal->renewal_id;

        if ($request->file('file')) {
            Storage::delete($trnRenewal->file);
            $file = $request->file('file');
            $extension = $file->extension();
            $fileUrl = $file->storeAs('uploads/files/transactions/renewal',  formatTimeDoc($trnRenewal->trn_no, $extension));
            $data['file'] = $fileUrl;
        } else {
            $data['file'] = $trnRenewal->file;
        }

        $trnRenewal->update($data);
        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function destroy(TrnRenewal $trnRenewal)
    {

        if ($trnRenewal->trn_status)
            return redirect()->back()->with('warning', 'Status is <b>CLOSED!</b>');

        Storage::delete($trnRenewal->file);
        $trnRenewal->delete();
        return redirect('/trn-renewal')->with('success', 'Successfully deleted!');
    }

    public function search(Request $request)
    {
        $data = TrnRenewal::search($request)->orderBy('trn_date', 'desc')->get();
        return $data;
    }

    public function updateStatus(TrnRenewal $trnRenewal)
    {
        if (!$trnRenewal->file)
            return redirect()->back()->with('warning', 'Upload file proven!');

        $trnRenewal->update([
            'trn_status' => 1
        ]);

        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function updateStatusPlan(TrnRenewal $trnRenewal)
    {
        if (!$trnRenewal->file)
            return redirect()->back()->with('warning', 'Upload file proven!');

        request()->validate([
            'trn_start_date' => 'required',
            'trn_date' => 'required'
        ]);

        $trnRenewal->update([
            'trn_status' => 1
        ]);

        $data = $this->setPlanData(request()->all(), $trnRenewal);
        TrnRenewal::create($data);

        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function setPlanData($request, $trn)
    {
        $date = createDate($request['trn_date']);
        $count = TrnRenewal::whereMonth('trn_date', $date->month)
            ->whereYear('trn_date', $date->year)
            ->count();
        $no = setNoTrn($request['trn_date'], $count ?? null, 'REN');

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

    public function download(TrnRenewal $trnRenewal)
    {
        $path = public_path() . $trnRenewal->takeDoc;
        return response()->download($path);
    }
}
