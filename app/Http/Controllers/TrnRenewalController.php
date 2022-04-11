<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Renewal;
use App\Models\Employee;
use App\Models\AssetChild;
use App\Models\TrnRenewal;
use App\Http\Requests\TrnRenewalRequest;

class TrnRenewalController extends Controller
{
    public function index()
    {
        $trnRenewals = TrnRenewal::get();
        $renewals = Renewal::get();
        $assets = Asset::get();
        $assetChild = AssetChild::get();
        $employees = Employee::get();

        return view('transaction.renewal.index', compact(
            'trnRenewals',
            'renewals',
            'assets',
            'assetChild',
            'employees',
        ));
    }

    public function store(TrnRenewalRequest $request)
    {
        // $validated = $request->validated();

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        if ($request->check == 0) {
            $data['asset_child_id'] = $data['asset_id'];
            unset($data['asset_id']);
        }

        $lastTrn = TrnRenewal::orderBy('trn_date', 'desc')->first();
        $data['trn_no'] = setNoTrn($data['trn_date'], $lastTrn, 'REN');

        TrnRenewal::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function show(TrnRenewal $trnRenewal)
    {
        return $trnRenewal;
        return view('transaction.renewal.show', compact('trnRenewal'));
    }

    public function edit(TrnRenewal $trnRenewal)
    {
        $trnRenewals = TrnRenewal::get();
        $employees = Employee::get();

        return view('transaction.renewal.edit', compact(
            'trnRenewal',
            'trnRenewals',
            'employees'
        ));
    }

    public function update(TrnRenewalRequest $request, TrnRenewal $trnRenewal)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['renewal_id'] = $trnRenewal->renewal_id;
        $data['asset_id'] = $trnRenewal->assets()->exists() ? $trnRenewal->asset_id : null;
        $data['asset_child_id'] = $trnRenewal->assetChildren()->exists() ? $trnRenewal->asset_child_id : null;

        $trnRenewal->update($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(TrnRenewal $trnRenewal)
    {
        $trnRenewal->delete();
        return redirect('/trn-renewal')->with('success', 'Success!');
    }
}
