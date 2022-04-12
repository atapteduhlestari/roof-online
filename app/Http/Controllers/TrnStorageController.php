<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Employee;
use App\Models\AssetChild;
use App\Models\Storage;
use App\Models\TrnStorage;
use Illuminate\Http\Request;
use App\Http\Requests\TrnStorageRequest;

class TrnStorageController extends Controller
{
    public function index()
    {
        $trnStorages = TrnStorage::get();
        $storages = Storage::get();
        $assets = Asset::orderBy('asset_name', 'asc')->get();
        $assetChild = AssetChild::orderBy('name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('transaction.storage.index', compact(
            'trnStorages',
            'storages',
            'assets',
            'assetChild',
            'employees'
        ));
    }

    public function create()
    {
        //
    }

    public function store(TrnStorageRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        if ($request->check == 0) {
            $data['asset_child_id'] = $data['asset_id'];
            unset($data['asset_id']);
        }

        $date = createDate($data['trn_date']);
        $count = TrnStorage::whereMonth('trn_date', $date->month)
            ->whereYear('trn_date', $date->year)
            ->count();

        $data['trn_no'] = setNoTrn($data['trn_date'], $count ?? null, 'STO');

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
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('transaction.storage.edit', compact(
            'trnStorage',
            'trnStorages',
            'employees'
        ));
    }

    public function update(TrnStorageRequest $request, TrnStorage $trnStorage)
    {
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
