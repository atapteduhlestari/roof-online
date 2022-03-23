<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Renewal;
use App\Models\AssetChild;
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
        return view('transaction.renewal.index', compact('trnRenewals', 'renewals', 'assets', 'assetChild'));
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
            'check' => 'required|boolean',
        ]);

        $data = $request->all();

        if (!$request->check) {
            $data['asset_child_id'] = $data['asset_id'];
            unset($data['asset_id']);

            TrnRenewal::create($data);
            return redirect()->back()->with('success', 'Success!');
        }

        TrnRenewal::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function show(TrnRenewal $trnRenewal)
    {
        //
    }

    public function edit(TrnRenewal $trnRenewal)
    {
        //
    }

    public function update(Request $request, TrnRenewal $trnRenewal)
    {
        //
    }

    public function destroy(TrnRenewal $trnRenewal)
    {
        $trnRenewal->delete();
        return redirect('/trn-renewal')->with('success', 'Success!');
    }
}
