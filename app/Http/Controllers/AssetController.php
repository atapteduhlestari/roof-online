<?php

namespace App\Http\Controllers;

use App\Models\SDB;
use App\Models\Asset;
use App\Models\Employee;
use App\Models\AssetChild;
use App\Models\AssetGroup;
use Illuminate\Http\Request;
use App\Http\Requests\AssetRequest;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::orderBy('asset_name', 'asc')->get();
        $assetGroup = AssetGroup::get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();

        return view('asset.parent.index', compact(
            'assets',
            'assetGroup',
            'employees',
            'SDBs'
        ));
    }

    public function store(AssetRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['pcs_value'] = removeDots($request->pcs_value);
        $data['apr_value'] = removeDots($request->apr_value);

        if ($request->file('image')) {
            $image = $request->file('image');
            $imageUrl = $image->storeAs('uploads/images/assets',  $image->hashName());
            $data['image'] = $imageUrl;
        }

        Asset::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function show(Asset $asset)
    {
        return $asset;
    }

    public function edit(Asset $asset)
    {
        $assetGroup = AssetGroup::get();
        $assets = Asset::get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();

        return view('asset.parent.edit', compact(
            'asset',
            'assets',
            'assetGroup',
            'employees',
            'SDBs'
        ));
    }

    public function update(AssetRequest $request, Asset $asset)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['pcs_value'] = removeDots($request->pcs_value);
        $data['apr_value'] = removeDots($request->apr_value);

        if ($request->file('image')) {

            Storage::delete($asset->image);
            $image = $request->file('image');
            $imageUrl = $image->storeAs('uploads/images/assets',  $image->hashName());
            $data['image'] = $imageUrl;
        } else {
            $data['image'] = $asset->image;
        }

        $asset->update($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(Asset $asset)
    {
        if ($asset->children()->exists()) {
            return redirect('/asset-parent')->with('warning', 'Cannot delete assets that have documents!');
        }

        if ($asset->trnMaintenance()->exists()) {
            return redirect('/asset')->with('warning', 'Cannot delete asset that have transactions!');
        }

        Storage::delete($asset->image);
        $asset->delete();
        return redirect('/asset-parent')->with('success', 'Success!');
    }

    public function documents(Asset $asset)
    {
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();
        return view('asset.parent.docs.index', compact('asset', 'SDBs'));
    }

    public function addDocuments(Request $request, Asset $asset)
    {
        $request->validate([
            'doc_name' => 'required',
            'doc_no' => 'required',
            'due_date' => 'required|date',
            'desc' => 'required',
        ]);

        $data = $request->all();
        $data['asset_id'] = $asset->id;

        $asset->children()->create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function editDocuments(Asset $asset, $childId)
    {
        $child = $asset->children()->where('id', $childId)->first();
        $children = AssetChild::where('id', '!=', $childId)->get();
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();

        return view('asset.parent.docs.edit', compact(
            'asset',
            'child',
            'children',
            'SDBs'
        ));
    }

    public function updateDocuments(Request $request, Asset $asset, $id)
    {
        $request->validate([
            'doc_name' => 'required',
            'doc_no' => 'required',
            'due_date' => 'required|date',
            'desc' => 'required',
        ]);

        $data = $request->all();

        $asset->children()
            ->where('id', $id)
            ->update([
                'doc_name' => $data['doc_name'],
                'doc_no' => $data['doc_no'],
                'due_date' => $data['due_date'],
                'desc' => $data['desc'],
            ]);

        return redirect()->back()->with('success', 'Success!');
    }

    public function deleteDocuments(Asset $asset, $childId)
    {
        if ($asset->children()->where('id', $childId)->trnRenewal()->exists()) {
            return redirect('/asset-parent/docs/' . $asset->id)->with('warning', 'Cannot delete document that have transactions!');
        }

        $asset->children()->where('id', $childId)->delete();
        return redirect('/asset-parent/docs/' . $asset->id)->with('success', 'Success!');
    }

    public function getData($id)
    {
        $data = Asset::find($id);
        $child = $data->children;

        return response()->json(
            $child,
        );
    }
}
