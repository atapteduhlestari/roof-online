<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $cycles = Cycle::get();
        $maintenances = Maintenance::get();
        return view('asset.maintenance.index', compact('maintenances', 'cycles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cycle_id' => 'required'
        ]);

        $data = $request->all();
        Maintenance::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function show(Maintenance $maintenance)
    {
        //
    }

    public function edit(Maintenance $maintenance)
    {
        $cycles = Cycle::get();
        $maintenances = Maintenance::get();
        return view('asset.maintenance.edit', compact('maintenance', 'maintenances', 'cycles'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'name' => 'required',
            'cycle_id' => 'required'
        ]);

        $data = $request->all();
        $maintenance->update($data);
        return redirect('/maintenance')->with('success', 'Success!');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect('/maintenance')->with('success', 'Success!');
    }
}
