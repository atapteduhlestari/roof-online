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
        $assetChild = AssetChild::orderBy('doc_name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('transaction.storage.index', compact(
            'trnStorages',
            'storages',
            'assets',
            'assetChild',
            'employees'
        ));
    }

    public function create(Request $request)
    {
        $check = $request->check;
        $storages = Storage::orderBy('name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $assets = null;

        switch ($check) {
            case 'document':
                $asset = AssetChild::find($request->id);
                return view('transaction.storage.docs.create', compact('asset', 'storages', 'employees'));
                break;

            case 'asset':
                $asset = Asset::find($request->id);
                return view('transaction.storage.create', compact('asset', 'storages', 'employees'));
                break;

            default:
                return redirect()->back()->with('warning', 'Oops something wrong, try again!');
                break;
        }
    }

    public function store(TrnStorageRequest $request)
    {
        $data = $request->all();

        if ($data['check'] == 0) {
            $data['asset_child_id'] = $data['asset_id'];
            unset($data['asset_id']);
        }

        $this->storeTrnData($data);
        TrnStorage::create($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function storeAsset(Request $request)
    {
        $request->validate([
            'trn_date' => 'required|date',
            'asset_id' => 'required',
            'storage_id' => 'required',
            'pemohon' => 'required',
            'penyetuju' => 'required',
        ]);

        $data = $request->all();
        $this->storeTrnData($data);

        return redirect()->back()->with('success', 'Success!');
    }


    public function storeDoc(Request $request)
    {
        $request->validate([
            'trn_date' => 'required|date',
            'asset_child_id' => 'required',
            'storage_id' => 'required',
            'pemohon' => 'required',
            'penyetuju' => 'required',
        ]);

        $data = $request->all();
        $this->storeTrnData($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function storeTrnData($data)
    {
        $data['user_id'] = auth()->user()->id;
        $date = createDate($data['trn_date']);
        $count = TrnStorage::whereMonth('trn_date', $date->month)
            ->whereYear('trn_date', $date->year)
            ->count();
        $data['trn_no'] = setNoTrn($data['trn_date'], $count ?? null, 'STO');

        TrnStorage::create($data);
        return;
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
