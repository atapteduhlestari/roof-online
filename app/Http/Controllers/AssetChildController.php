<?php

namespace App\Http\Controllers;

use App\Models\SDB;
use App\Models\Asset;
use App\Models\AssetChild;
use Illuminate\Http\Request;

class AssetChildController extends Controller
{
    public function index()
    {
        $children = AssetChild::with(['parent' => function ($q) {
            $q->orderBy('asset_name');
        }])->get();

        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();
        $assets = Asset::orderBy('asset_name', 'asc')->get();

        return view('asset.child.index', compact('children', 'assets', 'SDBs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doc_name' => 'required',
            'doc_no' => 'required',
            'due_date' => 'required',
            'asset_id' => 'required',
            'sbu_id' => 'required',
        ]);

        $data = $request->all();
        AssetChild::create($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function update(AssetChild $assetChild, Request $request)
    {
        $request->validate([
            'doc_name' => 'required',
            'doc_no' => 'required',
            'due_date' => 'required|date',
            'desc' => 'required',
        ]);

        $data = $request->all();
        $assetChild->update($data);
        return redirect()->back()->with('success', 'Success!');
    }
}
