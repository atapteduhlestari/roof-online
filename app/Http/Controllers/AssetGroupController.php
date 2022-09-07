<?php

namespace App\Http\Controllers;

use App\Models\SBU;
use App\Models\SDB;
use App\Models\Employee;
use App\Models\AssetGroup;
use Illuminate\Http\Request;

class AssetGroupController extends Controller
{
    public function index()
    {
        $asset_group = AssetGroup::get();
        return view('asset.group.index', compact('asset_group'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_group_name' => 'required',
        ]);

        $data = $request->all();
        AssetGroup::create($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function edit(AssetGroup $assetGroup)
    {
        $asset_group = AssetGroup::where('id', '!=', $assetGroup->id)->get();
        return view('asset.group.edit', compact('assetGroup', 'asset_group'));
    }

    public function show(AssetGroup $assetGroup)
    {


        $employees = Employee::orderBy('name', 'asc')->get();
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('asset.group.show', compact(
            'assetGroup',
            'employees',
            'SDBs',
            'SBUs'
        ));
    }

    public function update(Request $request, AssetGroup $assetGroup)
    {

        $request->validate([
            'asset_group_name' => 'required',
        ]);

        $data = $request->all();
        $assetGroup->update($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(AssetGroup $assetGroup)
    {
        if ($assetGroup->assets()->exists()) {
            return redirect('/asset-group')->with('warning', 'Cannot delete group that have assets!');
        }

        $assetGroup->delete();
        return redirect('/asset-group')->with('success', 'Success!');
    }
}
