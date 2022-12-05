<?php

namespace App\Http\Controllers;

use App\Models\SBU;
use App\Models\SDB;
use App\Models\Asset;
use App\Models\Employee;
use App\Models\AssetChild;
use App\Models\AssetGroup;
use App\Exports\AssetExportView;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\AssetRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class AssetController extends Controller
{
    public function index()
    {
        // $assets = Asset::where('sbu_id', 1)->where('image', null)->get();
        // return $assets;

        // foreach ($assets as $asset) {
        //     if ($asset->image) {
        //         if (!str_contains($asset->image, '.jpg')) {
        //             $asset->update([
        //                 'image' => $asset->image . '.jpg'
        //             ]);
        //         }
        //     }
        // }
        // return $assets;

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

    public function search($param)
    {
        $data = request()->all();

        if (isSuperadmin())
            $assets = $param == 'all' ? Asset::search($data)->get() : Asset::where('asset_group_id', $param)->search($data)->get();
        else
            $assets = $param == 'all' ? Asset::where('sbu_id', userSBU())->search($data)->get() : Asset::where('asset_group_id', $param)->where('sbu_id', userSBU())->search($data)->get();

        $assetGroup = AssetGroup::get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('asset.parent.search', compact(
            'assets',
            'assetGroup',
            'employees',
            'SDBs',
            'SBUs'
        ));
    }

    public function getData()
    {
        $asset = new Asset();
        $query = $asset->query();

        if (!isSuperadmin())
            $query = $asset->where('sbu_id', userSBU());

        $query->orderBy('sbu_id', 'asc');
        $dt = DataTables::of($query);

        $dt->addIndexColumn()->editColumn('pcs_date', function ($row) {
            return createDate($row->pcs_date)->format('d F Y');
        })->editColumn('pcs_value', function ($row) {
            return rupiah($row->pcs_value);
        })->addColumn('sbu', function (Asset $asset) {
            return $asset->sbu ? $asset->sbu->sbu_name : '';
        })->addColumn('employee', function (Asset $asset) {
            return $asset->employee ? $asset->employee->name : '';
        })->addColumn('condition', function (Asset $asset) {
            $color = $asset->condition == 1 ? 'text-success' : ($asset->condition == 2 ? 'text-warning' : 'text-danger');
            $text = $asset->condition == 1 ? 'Baik' : ($asset->condition == 2 ? 'Kurang' : 'Rusak');
            return "<span class='$color'> {$text}</span>";
        })->addColumn('action', function ($row) {
            return '<div class="d-flex justify-content-around">
            <div>
                <a title="Asset Detail" href="/asset-parent/docs/' . $row->id . '" class="btn btn-outline-dark btn-sm">Detail</a>
            </div>
            <div>
                <a title="Edit Data" href="/asset-parent/' . $row->id . '/edit" class="btn btn-outline-dark btn-sm">Edit</a>
            </div>
            <div>
                <form action="/asset-parent/' . $row->id . '" method="post" id="deleteForm">
                ' . csrf_field() . '
                ' . method_field("DELETE") . '
                    <button title="Delete Data" class="btn btn-outline-danger btn-sm" onclick="return false" id="deleteButton" data-id="' . $row->id . '"><i class="fas fa-trash-alt"></i></button>
                </form>
            </div>
        </div>';
        })->rawColumns(['action', 'condition']);

        return $dt->orderColumns(['asset_name'], '-:column $1')->toJson();
    }

    public function store(AssetRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['pcs_value'] = removeDots($request->pcs_value);

        if (isAdmin())
            $data['sbu_id'] = userSBU();

        if ($request->file('image')) {
            $image = $request->file('image');
            $extension = $image->extension();
            $imageUrl = $image->storeAs('uploads/images/assets', formatTimeDoc($request->asset_name, $extension));
            $data['image'] = $imageUrl;
        }

        Asset::create($data);
        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function show(Asset $asset)
    {
        return $asset;
    }

    public function export($param)
    {
        $data = request()->all();
        if (isSuperadmin())
            $assets = $param == 'all' ? Asset::with('sbu', 'employee')->filter($data)->get() : Asset::with('sbu', 'employee')->where('asset_group_id', $param)->filter($data)->get();
        else
            $assets = $param == 'all' ? Asset::with('sbu', 'employee')->where('sbu_id', userSBU())->filter($data)->get() : Asset::with('sbu', 'employee')->where('asset_group_id', $param)->where('sbu_id', userSBU())->filter($data)->get();

        $time = now()->format('dmY');
        $name = "ATL-GAN-ASSET-LIST-{$time}.xlsx";

        // return view('export.asset', compact('assets'));

        return Excel::download(new AssetExportView($assets), $name);
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

        if (isAdmin())
            $data['sbu_id'] = userSBU();

        if ($request->file('image')) {

            Storage::delete($asset->image);
            $image = $request->file('image');
            $extension = $image->extension();
            $imageUrl = $image->storeAs('uploads/images/assets', formatTimeDoc($request->asset_name, $extension));
            $data['image'] = $imageUrl;
        } else {
            $data['image'] = $asset->image;
        }
        $asset->update($data);
        return redirect()->back()->with('success', 'Successfully deleted!');
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
        return redirect('/asset-parent')->with('success', 'Successfully deleted!');
    }

    public function documents(Asset $asset)
    {
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();
        $SDBs = SDB::orderBy('sdb_name', 'asc')->get();

        if (isSuperadmin() || $asset->sbu_id == userSBU())
            return view('asset.parent.docs.index', compact('asset', 'SDBs', 'SBUs'));
        else
            return redirect()->back()->with('warning', 'Access Denied!');
    }

    public function addDocuments(Request $request, Asset $asset)
    {
        $request->validate([
            'doc_name' => 'required',
            'file' => 'nullable|file|max:5120',
        ]);

        $data = $request->all();
        $data['asset_id'] = $asset->id;
        $data['sbu_id'] = $request->sbu_id ?? $asset->sbu_id;

        if ($request->file('file')) {
            $file = $request->file('file');
            $extension = $file->extension();
            $fileUrl = $file->storeAs('uploads/files/docs',  formatTimeDoc($request->doc_name, $extension));
            $data['file'] = $fileUrl;
        }

        $asset->children()->create($data);
        return redirect()->back()->with('success', 'Successfully deleted!');
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

    // public function exportView()
    // {
    //     $assets = Asset::get();
    //     return view('export.asset', compact('assets'));
    //     return Excel::download(new AssetExportView, 'tes.xlsx');
    // }


    public static function generateButton($row)
    {
        '<div class="d-flex justify-content-around">
            <div>
                <a title="Asset Detail" href="/asset-parent/docs/' . $row->id . '" class="btn btn-outline-dark btn-sm">Detail</a>
            </div>
            <div>
                <a title="Edit Data" href="/asset-parent/' . $row->id . '/edit" class="btn btn-outline-dark btn-sm">Edit</a>
            </div>
            <div>
                <form action="/asset-parent/' . $row->id . '" method="post" id="deleteForm">
                ' . csrf_field() . '
                ' . method_field("DELETE") . '
                    <button title="Delete Data" class="btn btn-outline-danger btn-sm" onclick="return false" id="deleteButton" data-id="' . $row->id . '"><i class="fas fa-trash-alt"></i></button>
                </form>
            </div>
        </div>';
    }
}
