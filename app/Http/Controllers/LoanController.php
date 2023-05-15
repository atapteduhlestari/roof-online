<?php

namespace App\Http\Controllers;

use App\Models\SBU;
use App\Models\Loan;
use App\Models\Asset;
use App\Models\Employee;
use App\Models\AssetChild;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoanExportDetailView;
use App\Exports\LoanExportDetailView as ExportsLoanExportDetailView;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::get();

        $assets = Asset::whereDoesntHave('loans', function ($q) {
            $q->where('loan_status', 0);
        })->orderBy('sbu_id', 'asc')->orderBy('pcs_date', 'desc')->get();

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
        $employees = Employee::orderBy('name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('transaction.loan.edit', compact(
            'loan',
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

    public function detailView()
    {
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();
        return view('report.detail.loan', compact('SBUs'));
    }

    public function reportDetail()
    {
        if (request('start') > request('end'))
            return redirect()->back()->with('warning', 'Start date must be lower than End date');

        $data['request'] = request()->all();

        if (isSuperadmin())
            $data['loans'] =  Loan::filter($data['request'])->orderBy('loan_start_date')->get();
        else
            $data['loans'] = Loan::filter($data['request'])->where('sbu_id', userSBU())->orderBy('loan_start_date')->get();

        if (count($data['loans']) <= 0)
            return redirect()->back()->with('warning', 'No data available');

        $sbu = SBU::find(request('sbu_id'));
        $time = now()->format('dmY') . '-' . uniqid();
        $name = "ATL-GAN-LOAN-DETAIL-{$time}.xlsx";

        $data['sbu'] = request('sbu_id') ? $sbu->sbu_name : 'All';
        $data['status'] = (request('status') == 1) ? 'Closed' : ((request('status') == null) ? 'All' : 'Open');
        $data['periode'] = getPeriodeExport(request());
        $data['total_data'] = $data['loans']->count();

        $loans = $data;
        return view('export.loan', compact('loans'));
        return Excel::download(new LoanExportDetailView($data), $name);
    }

    public function destroy(Loan $loan)
    {
        if ($loan->loan_status)
            return redirect()->back()->with('warning', 'Status is <b>CLOSED!</b>');

        $loan->delete();
        return redirect('/loan')->with('success', 'Successfully deleted!');
    }
}
