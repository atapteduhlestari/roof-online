<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::get();
        return view('asset.maintenance.index', compact('maintenances'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
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
        $maintenances = Maintenance::get();
        return view('asset.maintenance.edit', compact('maintenance', 'maintenances'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'name' => 'required',
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
