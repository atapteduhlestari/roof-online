<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Renewal;
use Illuminate\Http\Request;

class RenewalController extends Controller
{
    public function index()
    {
        $cycles = Cycle::get();
        $renewals = Renewal::get();
        return view('asset.renewal.index', compact('renewals', 'cycles'));
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
        ]);

        $data = $request->all();
        $renewal->update($data);

        return redirect('/renewal')->with('success', 'Success!');
    }

    public function destroy(Renewal $renewal)
    {
        $renewal->delete();
        return redirect('/renewal')->with('success', 'Success!');
    }
}
