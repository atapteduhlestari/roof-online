<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetChild;
use App\Models\SDB;
use App\Models\TrnSDB;
use App\Models\TrnSDBDetail;
use Illuminate\Http\Request;

class TrnSDBController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $sdb = SDB::findOrFail($request->id);
        return view('transaction.sdb.create', compact('sdb'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sdb_id' => 'required',
            'ren_date' => 'required',
            'ren_value' => 'required',
            'due_date' => 'required',
        ]);

        $data = $this->storeTrnData($request->all());
        TrnSDB::create($data);

        SDB::firstWhere('id', $data['sdb_id'])
            ->update([
                'due_date' => $data['due_date']
            ]);

        return redirect()->back()->with('success', 'Success!');
    }

    public function storeTrnData($data)
    {
        $date = createDate($data['ren_date']);
        $count = TrnSDB::whereMonth('ren_date', $date->month)
            ->whereYear('ren_date', $date->year)
            ->count();

        $data['user_id'] = auth()->user()->id;
        $data['trn_no'] = setNoTrn($data['ren_date'], $count ?? null, 'SDB');
        $data['ren_value'] = removeDots($data['ren_value']);

        return $data;
    }


    public function show(TrnSDB $trnSDB)
    {
        //
    }

    public function edit(TrnSDB $trnSDB)
    {
        return view('transaction.sdb.edit', compact('trnSDB'));
    }

    public function update(Request $request, TrnSDB $trnSDB)
    {
        $data = $request->all();

        $data['user_id'] = auth()->user()->id;
        $data['sdb_id'] = $trnSDB->sdb_id;
        $data['ren_value'] = removeDots($request->ren_value);

        SDB::firstWhere('id', $data['sdb_id'])
            ->update([
                'due_date' => $data['due_date']
            ]);

        $trnSDB->update($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(TrnSDB $trnSDB)
    {
        $trnSDB->delete();
        return redirect()->back()->with('success', 'Success!');
    }

    public function formAsset(Request $request)
    {
        $sdb = SDB::findOrFail($request->sdb_id);
        $asset = Asset::findOrFail($request->asset_id);

        return view('transaction.sdb.trn.trn_asset', compact('sdb', 'asset'));
    }

    public function storeAsset(Request $request)
    {
        $request->validate([
            'sdb_id' => 'required',
            'asset_id' => 'required',
            'take_out' => 'required|date',
        ]);

        $data = $request->all();

        if ($data['back_in']) {
            $data['status'] = 1;
        }

        $data['status'] = 0;

        TrnSDBDetail::updateOrCreate(
            [
                'asset_id' => $data['asset_id'],
            ],
            [
                'sdb_id' => $data['sdb_id'],
                'take_out' => $data['take_out'],
                'back_in' => $data['back_in'],
            ]
        );

        return redirect("/sdb/{$data['sdb_id']}")->with('success', 'Success!');
    }

    public function formDoc(Request $request)
    {
        $sdb = SDB::findOrFail($request->sdb_id);
        $doc = AssetChild::findOrFail($request->asset_child_id);

        return view('transaction.sdb.trn.trn_doc', compact('sdb', 'doc'));
    }

    public function storeDoc(Request $request)
    {
        $request->validate([
            'sdb_id' => 'required',
            'asset_child_id' => 'required',
            'take_out' => 'required|date',
        ]);

        $data = $request->all();

        if ($data['back_in']) {
            return 'yes';
        }

        return $data;

        TrnSDBDetail::updateOrCreate(
            [
                'asset_child_id' => $data['asset_child_id'],
            ],
            [
                'sdb_id' => $data['sdb_id'],
                'take_out' => $data['take_out'],
                'back_in' => $data['back_in'],
            ]
        );

        return redirect("/sdb/{$data['sdb_id']}")->with('success', 'Success!');
    }

    public function deleteAsset($id)
    {
        $asset = Asset::firstWhere('id', $id);
        $asset->update([
            'sdb_id' => null,
        ]);

        return redirect()->back()->with('success', 'Success!');
    }

    public function deleteDoc($id)
    {
        $doc = AssetChild::firstWhere('id', $id);
        $doc->update([
            'sdb_id' => null,
        ]);

        return redirect()->back()->with('success', 'Success!');
    }
}
