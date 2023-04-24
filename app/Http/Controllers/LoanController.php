<?php

namespace App\Http\Controllers;

use App\Models\SBU;
use App\Models\Loan;
use App\Models\Asset;
use App\Models\Employee;
use App\Models\AssetChild;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::get();
        $assets = Asset::orderBy('sbu_id', 'asc')->orderBy('pcs_date', 'desc')->get();
        $assetChild = AssetChild::orderBy('doc_name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('transaction.loan.index', compact(
            'loans',
            'assets',
            'assetChild',
            'employees',
            'SBUs'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'loan_type' => 'required',
            'loan_start_date' => 'required',
            'loan_due_date' => 'required',
            'peminjam' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        Loan::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function show(Loan $loan)
    {
        //
    }

    public function edit(Loan $loan)
    {
        $assets = Asset::orderBy('sbu_id', 'asc')->orderBy('pcs_date', 'desc')->get();
        $assetChild = AssetChild::orderBy('doc_name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('transaction.loan.edit', compact(
            'loan',
            'assets',
            'assetChild',
            'employees',
            'SBUs'
        ));
    }

    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'loan_type' => 'required',
            'loan_start_date' => 'required',
            'loan_due_date' => 'required',
            'peminjam' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        if ($loan->type)
            $data['asset_id'] = $loan->asset_id;
        else
            $data['asset_child_id'] = $loan->asset_child_id;

        $loan->update($data);
        return redirect('/loan')->with('success', 'Success!');
    }

    public function destroy(Loan $loan)
    {
        return $loan;
    }
}
