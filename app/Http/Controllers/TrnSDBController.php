<?php

namespace App\Http\Controllers;

use App\Models\SDB;
use App\Models\TrnSDB;
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
        //
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
}
