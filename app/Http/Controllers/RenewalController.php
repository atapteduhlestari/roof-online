<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Renewal;
use Illuminate\Http\Request;
use App\Rules\DocumentFormat;

class RenewalController extends Controller
{
    public function index()
    {
        $cycles = Cycle::get();
        $renewals = Renewal::get();

        $lastNoDoc = $renewals->last();
        $no_doc = "ATL-HOJ-SOP-GAN-0#-##";

        return view('asset.renewal.index', compact(
            'renewals',
            'cycles',
            'no_doc'
        ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cycle_id' => 'required',
            'no_doc' =>  ['nullable', new DocumentFormat],
        ]);

        $data = $request->all();
        Renewal::create($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function show(Renewal $renewal)
    {
        //
    }

    public function edit(Renewal $renewal)
    {
        $cycles = Cycle::get();
        $renewals = Renewal::get();
        return view('asset.renewal.edit', compact('renewal', 'renewals', 'cycles'));
    }

    public function update(Request $request, Renewal $renewal)
    {
        $request->validate([
            'name' => 'required',
            'cycle_id' => 'required',
            'no_doc' =>  ['nullable', "unique:asset_renewal,no_doc,{$renewal->id}", new DocumentFormat],
        ]);

        $data = $request->all();
        $renewal->update($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(Renewal $renewal)
    {
        $renewal->delete();
        return redirect('/renewal')->with('success', 'Success!');
    }
}
