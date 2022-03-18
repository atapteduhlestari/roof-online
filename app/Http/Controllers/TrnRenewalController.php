<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetChild;
use App\Models\TrnRenewal;
use Illuminate\Http\Request;

class TrnRenewalController extends Controller
{
    public function index()
    {
        $trnRenewals = TrnRenewal::get();
        return view('transaction.renewal.index', compact('trnRenewals'));
    }

    public function create()
    {
        //
    }

    public function createParent(Request $request)
    {
        //
    }

    public function createChild(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        //
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
        //
    }
}
