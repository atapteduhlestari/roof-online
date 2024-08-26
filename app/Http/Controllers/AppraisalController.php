<?php

namespace App\Http\Controllers;

use App\Models\Appraisal;
use App\Models\Asset;
use Illuminate\Http\Request;

class AppraisalController extends Controller
{
    public function index()
    {
        $appraisals = isSuperAdmin() ? Appraisal::get() : Appraisal::where('sbu_id', userSBU())->get();
        $assets = isSuperAdmin() ? Asset::orderBy('asset_name', 'ASC')->get() : Asset::where('sbu_id', userSBU())->orderBy('asset_name', 'ASC')->get();

        return view('asset.appraisal.index', compact('appraisals', 'assets'));
    }

    public function create(Request $request)
    {
        $id = $request->asset_id;
        $asset = Asset::findOrFail($id);
        $this->authorize('update', $asset);

        return view('asset.appraisal.create', compact('asset'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required',
            'apr_date' => 'required|date',
            'apr_value' => 'required',
        ]);

        $asset = Asset::findOrFail($request->asset_id);
        $this->authorize('update', $asset);

        $data = $request->all();
        $data['apr_value'] = removeDots($request->apr_value);

        Appraisal::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function edit(Appraisal $appraisal)
    {
        return view('asset.appraisal.edit', compact('appraisal'));
    }

    public function update(Request $request, Appraisal $appraisal)
    {
        $request->validate([
            'asset_id' => 'required',
            'apr_date' => 'required|date',
            'apr_value' => 'required',
        ]);

        $asset = Asset::findOrFail($request->asset_id);
        $this->authorize('update', $asset);

        $data = $request->all();
        $data['apr_value'] = removeDots($request->apr_value);

        $appraisal->update($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(Appraisal $appraisal)
    {
        $appraisal->delete();
        return redirect()->back()->with('success', 'Success!');
    }
}
