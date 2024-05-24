<?php

namespace App\Http\Controllers;

use App\Models\SBU;
use App\Models\SDB;
use App\Models\Employee;
use App\Models\AssetGroup;
use App\Rules\SpecialCharacter;
use Illuminate\Http\Request;

class AssetGroupController extends Controller
{
    public function index()
    {
        $asset_group = AssetGroup::get();
        return view('asset.group.asset.index', compact('asset_group'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_group_name' => ['required', new SpecialCharacter]
        ]);

        $data = $request->all();
        AssetGroup::create($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function edit(AssetGroup $assetGroup)
    {
        $asset_group = AssetGroup::where('id', '!=', $assetGroup->id)->get();
        return view('asset.group.asset.edit', compact('assetGroup', 'asset_group'));
    }

    public function show(AssetGroup $assetGroup)
    {
        $employees = Employee::orderBy('name', 'asc')->get();
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();
        $assets = isSuperadmin() ? $assetGroup->assets()->orderBy('sbu_id', 'asc')->orderBy('pcs_date', 'desc')->get() :
            $assetGroup->assets()->where('sbu_id', userSBU())->orderBy('sbu_id', 'asc')->orderBy('pcs_date', 'desc')->get();

        return view('asset.group.asset.show', compact(
            'assetGroup',
            'assets',
            'employees',
            'SDBs',
            'SBUs'
        ));
    }

    public function update(Request $request, AssetGroup $assetGroup)
    {
        $request->validate([
            'asset_group_name' => ['required', new SpecialCharacter]
        ]);

        $data = $request->all();
        $assetGroup->update($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(AssetGroup $assetGroup)
    {
        if ($assetGroup->assets()->exists())
            return redirect('/asset-group')->with('warning', 'Cannot delete group that have assets!');

        $assetGroup->delete();
        return redirect('/asset-group')->with('success', 'Success!');
    }
}
