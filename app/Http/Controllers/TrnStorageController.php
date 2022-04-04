<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Employee;
use App\Models\AssetChild;
use App\Models\Storage;
use App\Models\TrnStorage;
use Illuminate\Http\Request;

class TrnStorageController extends Controller
{
    public function index()
    {
        $trnStorages = TrnStorage::get();
        $storages = Storage::get();
        $assets = Asset::get();
        $assetChild = AssetChild::get();
        $employees = Employee::get();
        return view('transaction.storage.index', compact('trnStorages', 'storages', 'assets', 'assetChild', 'employees'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'trn_no' => 'required',
            'trn_date' => 'required',
            'asset_id' => 'required',
            'storage_id' => 'required',
            'pelaksana' => 'required',
            'penyetuju' => 'required',
            'check' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        if ($request->check == 0) {
            $data['asset_child_id'] = $data['asset_id'];
            unset($data['asset_id']);
        }

        TrnStorage::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function show(TrnStorage $trnStorage)
    {
        //
    }

    public function edit(TrnStorage $trnStorage)
    {
        $trnStorages = TrnStorage::get();
        $employees = Employee::get();
        return view('transaction.storage.edit', compact('trnStorage', 'trnStorages', 'employees'));
    }

    public function update(Request $request, TrnStorage $trnStorage)
    {
        $request->validate([
            'trn_date' => 'required',
            'pelaksana' => 'required',
            'penyetuju' => 'required'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['storage_id'] = $trnStorage->storage_id;
        $data['asset_id'] = $trnStorage->assets()->exists() ? $trnStorage->asset_id : null;
        $data['asset_child_id'] = $trnStorage->assetChildren()->exists() ? $trnStorage->asset_child_id : null;

        $trnStorage->update($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(TrnStorage $trnStorage)
    {
        $trnStorage->delete();
        return redirect('/trn-storage')->with('success', 'Success!');
    }
}
