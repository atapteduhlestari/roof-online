<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Renewal;
use App\Models\Employee;
use App\Models\AssetChild;
use App\Models\TrnRenewal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TrnRenewalRequest;

class TrnRenewalController extends Controller
{
    public function index()
    {
        $trnRenewals = TrnRenewal::orderBy('trn_date', 'desc')->get();
        $renewals = Renewal::get();
        $assetChild = AssetChild::orderBy('doc_name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('transaction.renewal.index', compact(
            'trnRenewals',
            'renewals',
            'assetChild',
            'employees',
        ));
    }

    public function create(Request $request)
    {
        $renewals = Renewal::orderBy('name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $assetChild = AssetChild::findOrFail($request->id);

        return view('transaction.renewal.create', compact(
            'assetChild',
            'renewals',
            'employees'
        ));
    }

    public function store(TrnRenewalRequest $request)
    {
        $data = $this->storeTrnData($request->all());

        if ($request->file('file')) {
            $file = $request->file('file');
            $fileUrl = $file->storeAs('uploads/files/transactions/renewal',  $file->hashName());
            $data['file'] = $fileUrl;
        }

        TrnRenewal::create($data);
        return redirect()->back()->with('success', 'Success!');
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
        return view('transaction.renewal.show', compact('trnRenewal'));
    }

    public function edit(TrnRenewal $trnRenewal)
    {
        $renewals = Renewal::get();
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('transaction.renewal.edit', compact(
            'trnRenewal',
            'renewals',
            'employees'
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
            $fileUrl = $file->storeAs('uploads/files/transactions/renewal',  $file->hashName());
            $data['file'] = $fileUrl;
        } else {
            $data['file'] = $trnRenewal->file;
        }

        $trnRenewal->update($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(TrnRenewal $trnRenewal)
    {
        Storage::delete($trnRenewal->file);
        $trnRenewal->delete();
        return redirect('/trn-renewal')->with('success', 'Success!');
    }

    public function search(Request $request)
    {
        $data = TrnRenewal::filter($request)->orderBy('trn_date', 'desc')->get();
        return $data;
    }

    public function updateStatus(TrnRenewal $trnRenewal)
    {
        if (!$trnRenewal->file)
            return redirect()->back()->with('warning', 'Upload a file to proof!');

        $trnRenewal->update([
            'trn_status' => 1
        ]);
        return redirect()->back()->with('success', 'Success!');
    }

    public function download(TrnRenewal $trnRenewal)
    {
        $path = public_path() . $trnRenewal->takeDoc;
        return response()->download($path);
    }
}
