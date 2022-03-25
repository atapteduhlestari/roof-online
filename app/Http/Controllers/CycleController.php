<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use Illuminate\Http\Request;

class CycleController extends Controller
{
    public function index()
    {
        $cycles = Cycle::get();
        return view('asset.cycle.index', compact('cycles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'cycle_name' => 'required',
            'cycle_type' => 'required',
            'qty' => 'required'
        ]);
        $data = $request->all();

        Cycle::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function show(Cycle $cycle)
    {
        //
    }

    public function edit(Cycle $cycle)
    {
        $cycles = Cycle::get();
        return view('asset.cycle.edit', compact('cycles', 'cycle'));
    }

    public function update(Request $request, Cycle $cycle)
    {
        $request->validate([
            'cycle_name' => 'required',
            'cycle_type' => 'required',
            'qty' => 'required'
        ]);
        $data = $request->all();

        $cycle->update($data);
        return redirect('/cycle')->with('success', 'Success!');
    }

    public function destroy(Cycle $cycle)
    {
        $cycle->renewals()
            ->where('cycle_id', $cycle->id)
            ->update(['cycle_id' => null]);

        $cycle->maintenances()
            ->where('cycle_id', $cycle->id)
            ->update(['cycle_id' => null]);

        $cycle->delete();
        return redirect('/cycle')->with('success', 'Success!');
    }
}
