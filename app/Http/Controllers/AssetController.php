<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetChild;
use App\Models\AssetGroup;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::orderBy('asset_name', 'asc')->get();
        $assetGroup = AssetGroup::get();
        return view('asset.parent.index', compact('assets', 'assetGroup'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'asset_name' => 'required',
            'asset_group_id' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        Asset::create($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function show(Asset $asset)
    {
        //
    }

    public function edit(Asset $asset)
    {
        $assetGroup = AssetGroup::get();
        $assets = Asset::get();
        return view('asset.parent.edit', compact('asset', 'assets', 'assetGroup'));
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'asset_name' => 'required',
            'asset_group_id' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $asset->update($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(Asset $asset)
    {
        if ($asset->children()->exists()) {
            return redirect('/asset-parent')->with('warning', 'Cannot delete assets that have documents!');
        }
        $asset->delete();
        return redirect('/asset-parent')->with('success', 'Success!');
    }

    public function documents(Asset $asset)
    {
        return view('asset.parent.docs.index', compact('asset'));
    }

    public function addDocuments(Request $request, Asset $asset)
    {
        $request->validate([
            'name' => 'required',
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
        return view('asset.parent.docs.edit', compact('asset', 'child', 'children'));
    }

    public function updateDocuments(Request $request, Asset $asset, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();

        $asset->children()
            ->where('id', $id)
            ->update([
                'name' => $data['name'],
                'desc' => $data['desc'],
            ]);

        return redirect()->back()->with('success', 'Success!');
    }

    public function deleteDocuments(Asset $asset, $childId)
    {
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
