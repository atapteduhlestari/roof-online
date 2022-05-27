<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Renewal;
use App\Rules\ISOFormatRule;
use Illuminate\Http\Request;
use App\Rules\DocumentFormat;

class RenewalController extends Controller
{
    public function index()
    {
        // $cycles = Cycle::get();
        $renewals = Renewal::get();

        $lastNoDoc = $renewals->last();
        $no_doc = "ATL-HOJ-SOP-GAN-0#-##";

        return view('asset.renewal.index', compact('renewals', 'no_doc'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'no_doc' =>  ['nullable', new DocumentFormat, new ISOFormatRule],
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
        // $cycles = Cycle::get();
        $renewals = Renewal::get();
        return view('asset.renewal.edit', compact('renewal', 'renewals'));
    }

    public function update(Request $request, Renewal $renewal)
    {
        $request->validate([
            'name' => 'required',
            'no_doc' =>  [
                'nullable',
                new DocumentFormat,
                new ISOFormatRule
            ],
        ]);

        $data = $request->all();
        $renewal->update($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(Renewal $renewal)
    {
        if ($renewal->transactions()->exists()) {
            return redirect('/renewal')->with('warning', 'Cannot delete renewal that have transactions!');
        }

        $renewal->delete();
        return redirect('/renewal')->with('success', 'Success!');
    }
}
