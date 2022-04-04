<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Renewal;
use App\Models\AssetChild;
use App\Models\Employee;
use App\Models\TrnRenewal;
use Illuminate\Http\Request;

class TrnRenewalController extends Controller
{
    public function index()
    {
        $trnRenewals = TrnRenewal::get();
        $renewals = Renewal::get();
        $assets = Asset::get();
        $assetChild = AssetChild::get();
        $employees = Employee::get();
        return view('transaction.renewal.index', compact('trnRenewals', 'renewals', 'assets', 'assetChild', 'employees'));
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
            'renewal_id' => 'required',
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

        TrnRenewal::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function show(TrnRenewal $trnRenewal)
    {
        return view('transaction.renewal.show', compact('trnRenewal'));
    }

    public function edit(TrnRenewal $trnRenewal)
    {
        $trnRenewals = TrnRenewal::get();
        $employees = Employee::get();
        return view('transaction.renewal.edit', compact('trnRenewal', 'trnRenewals', 'employees'));
    }

    public function update(Request $request, TrnRenewal $trnRenewal)
    {

        $request->validate([
            'trn_date' => 'required',
            'pelaksana' => 'required',
            'penyetuju' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['renewal_id'] = $trnRenewal->renewal_id;
        $data['asset_id'] = $trnRenewal->assets()->exists() ? $trnRenewal->asset_id : null;
        $data['asset_child_id'] = $trnRenewal->assetChildren()->exists() ? $trnRenewal->asset_child_id : null;

        $trnRenewal->update($data);
        return redirect('/trn-renewal')->with('success', 'Success!');
    }

    public function destroy(TrnRenewal $trnRenewal)
    {
        $trnRenewal->delete();
        return redirect('/trn-renewal')->with('success', 'Success!');
    }
}
