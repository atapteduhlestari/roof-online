<?php

namespace App\Http\Controllers;

use App\Models\SBU;
use App\Models\SDB;
use App\Models\Asset;
use App\Models\AssetChild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetChildController extends Controller
{
    public function index()
    {
        $children = AssetChild::with([
            'parent' => fn ($q) => $q->orderBy('asset_name')
        ]);

        $children = isSuperadmin() ? $children->get() : $children->where('sbu_id', userSBU())->get();
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'desc')->get();
        $assets = Asset::orderBy('asset_name', 'asc')->get();

        return view('asset.child.index', compact(
            'children',
            'assets',
            'SDBs',
            'SBUs'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doc_name' => 'required',
            'sbu_id' => 'required',
            'file' => 'nullable|file|max:5120',
        ]);

        $data = $request->all();

        if ($request->file('file')) {
            $file = $request->file('file');
            $fileUrl = $file->storeAs('uploads/files/docs',  formatTimeDoc($request->doc_name));
            $data['file'] = $fileUrl;
        }

        AssetChild::create($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function edit(AssetChild $assetChild)
    {
        $child = $assetChild;
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('asset.child.edit', compact(
            'child',
            'SDBs',
            'SBUs'
        ));
    }

    public function update(AssetChild $assetChild, Request $request)
    {
        $request->validate([
            'doc_name' => 'required',
            'sbu_id' => 'required',
            'file' => 'nullable|file|max:5120'
        ]);

        $data = $request->all();

        if ($request->file('file')) {
            Storage::delete($assetChild->file);
            $file = $request->file('file');
            $fileUrl = $file->storeAs('uploads/files/docs',  formatTimeDoc($request->doc_name));
            $data['file'] = $fileUrl;
        } else {
            $data['file'] = $assetChild->file;
        }


        $assetChild->update($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function download(AssetChild $assetChild)
    {
        $path = public_path() . $assetChild->takeDoc;
        return response()->download($path);
    }

    public function destroy(AssetChild $assetChild)
    {

        if ($assetChild->trnRenewal()->exists()) {
            return redirect('/asset-child')->with('warning', 'Cannot delete document that have transactions!');
        }

        Storage::delete($assetChild->file);
        $assetChild->delete();

        return redirect('/asset-child')->with('success', 'Success!');
    }
}
