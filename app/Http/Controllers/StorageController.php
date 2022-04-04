<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index()
    {
        $cycles = Cycle::get();
        $storages = Storage::get();
        return view('asset.storage.index', compact('storages', 'cycles'));
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
        ]);

        $data = $request->all();
        $storage->update($data);

        return redirect('/storage')->with('success', 'success');
    }

    public function destroy(Storage $storage)
    {
        $storage->delete();
        return redirect('/storage')->with('success', 'Success!');
    }
}
