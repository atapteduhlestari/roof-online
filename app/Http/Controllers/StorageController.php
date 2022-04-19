<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Storage;
use Illuminate\Http\Request;
use App\Rules\DocumentFormat;
use App\Rules\ISOFormatRule;
use Illuminate\Validation\Rule;

class StorageController extends Controller
{
    public function index()
    {
        $cycles = Cycle::get();
        $storages = Storage::get();

        $lastNoDoc = $storages->last();
        $no_doc = "ATL-HOJ-SOP-GAN-0#-##";

        return view('asset.storage.index', compact(
            'storages',
            'cycles',
            'no_doc'
        ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'no_doc' =>  ['nullable', new DocumentFormat, new ISOFormatRule],
        ]);

        $data = $request->all();
        Storage::create($data);

        return redirect()->back()->with('success', 'success');
    }

    public function show(Storage $storage)
    {
        //
    }

    public function edit(Storage $storage)
    {
        $cycles = Cycle::get();
        $storages = Storage::get();
        return view('asset.storage.edit', compact('storage', 'storages', 'cycles'));
    }

    public function update(Request $request, Storage $storage)
    {
        $request->validate([
            'name' => 'required',
            'no_doc' =>  [
                'nullable',
                "unique:asset_storage,no_doc,{$storage->id}",
                new DocumentFormat, new ISOFormatRule
            ],
        ]);

        $data = $request->all();
        $storage->update($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(Storage $storage)
    {
        $storage->delete();
        return redirect('/mst-storage')->with('success', 'Success!');
    }
}
