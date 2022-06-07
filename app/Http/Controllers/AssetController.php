<?php

namespace App\Http\Controllers;

use App\Models\SBU;
use App\Models\SDB;
use App\Models\Asset;
use App\Models\Employee;
use App\Models\AssetChild;
use App\Models\AssetGroup;
use App\Exports\AssetExport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\AssetRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class AssetController extends Controller
{
    public function index()
    {
        // $assets = Asset::orderBy('asset_name', 'asc')->get(); 
        $assetGroup = AssetGroup::get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('asset.parent.index', compact(
            'assetGroup',
            'employees',
            'SDBs',
            'SBUs'
        ));
    }

    public function getData()
    {
        $query = Asset::query();
        $dt = DataTables::eloquent($query);

        $dt->addIndexColumn()
            ->editColumn('pcs_date', function ($row) {
                return createDate($row->pcs_date)->format('d F Y');
            })
            ->editColumn('pcs_value', function ($row) {
                return rupiah($row->pcs_value);
            })
            ->addColumn('sbu', function (Asset $asset) {
                return $asset->sbu ? $asset->sbu->sbu_name : '';
            })
            ->addColumn('employee', function (Asset $asset) {
                return $asset->employee ? $asset->employee->name : '';
            })
            ->addColumn('action', function ($row) {
                return
                    '<div class="d-flex justify-content-around">
                <div>
                    <a title="Asset Detail" href="/asset-parent/docs/' . $row->id . '"
                        class="btn btn-outline-dark btn-sm">Detail</a>
                </div>
                <div>
                    <a title="Edit Data" href="/asset-parent/' . $row->id . '/edit"
                        class="btn btn-outline-dark btn-sm">Edit</a>
                </div>
                <div>
                    <form action="/asset-parent/' . $row->id . '" method="post"
                        id="deleteForm">
                       ' . csrf_field() . '
                       ' . method_field("DELETE") . '
                        <button title="Delete Data" class="btn btn-outline-danger btn-sm"
                            onclick="return false" id="deleteButton"
                            data-id="' . $row->id . '">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>';
            })->rawColumns(['action']);

        return $dt->toJson();
    }

    public function store(AssetRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['pcs_value'] = removeDots($request->pcs_value);
        $data['apr_value'] = removeDots($request->apr_value);

        if ($request->file('image')) {
            $image = $request->file('image');
            $imageUrl = $image->storeAs('uploads/images/assets',  $image->hashName());
            $data['image'] = $imageUrl;
        }

        Asset::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function show(Asset $asset)
    {
        return $asset;
    }

    public function export($param)
    {
        $data = $param == 'all' ? Asset::with('sbu', 'employee')->get() : Asset::with('sbu', 'employee')->where('asset_group_id', $param)->get();
        $name = 'asset.xlsx';

        return Excel::download(new AssetExport($data), $name);
    }

    public function edit(Asset $asset)
    {
        $assetGroup = AssetGroup::get();
        $assets = Asset::get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('asset.parent.edit', compact(
            'asset',
            'assets',
            'assetGroup',
            'employees',
            'SDBs',
            'SBUs'
        ));
    }

    public function update(AssetRequest $request, Asset $asset)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['pcs_value'] = removeDots($request->pcs_value);
        $data['apr_value'] = removeDots($request->apr_value);

        if ($request->file('image')) {

            Storage::delete($asset->image);
            $image = $request->file('image');
            $imageUrl = $image->storeAs('uploads/images/assets',  $image->hashName());
            $data['image'] = $imageUrl;
        } else {
            $data['image'] = $asset->image;
        }

        $asset->update($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(Asset $asset)
    {
        if ($asset->children()->exists()) {
            return redirect('/asset-parent')->with('warning', 'Cannot delete assets that have documents!');
        }

        if ($asset->trnMaintenance()->exists()) {
            return redirect('/asset')->with('warning', 'Cannot delete asset that have transactions!');
        }

        Storage::delete($asset->image);
        $asset->delete();
        return redirect('/asset-parent')->with('success', 'Success!');
    }

    public function documents(Asset $asset)
    {
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();
        return view('asset.parent.docs.index', compact('asset', 'SDBs', 'SBUs'));
    }

    public function addDocuments(Request $request, Asset $asset)
    {
        $request->validate([
            'doc_name' => 'required',
            'doc_no' => 'required',
        ]);

        $data = $request->all();
        $data['asset_id'] = $asset->id;
        $data['sbu_id'] = $request->sbu_id ?? $asset->sbu_id;

        if ($request->file('file')) {
            $file = $request->file('file');
            $fileUrl = $file->storeAs('uploads/files/docs',  $file->hashName());
            $data['file'] = $fileUrl;
        }

        $asset->children()->create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function editDocuments(Asset $asset, $childId)
    {
        $child = AssetChild::find($childId);
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('asset.parent.docs.edit', compact(
            'asset',
            'child',
            'SDBs',
            'SBUs'
        ));
    }
}
