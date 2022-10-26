@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Asset Group')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Asset Group | {{ $assetGroup->asset_group_name }}</h1>

        <div class="d-flex">
            <div class="my-3 flex-grow-1">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addNewRecord">
                    Add <i class="fas fa-plus-circle"></i>
                </button>

                <button class="btn btn-outline-dark" type="button" data-toggle="collapse" data-target="#collapseExample"
                    aria-expanded="false" aria-controls="collapseExample">
                    Export <i class="fas fa-file-export"></i>
                </button>
            </div>

            <div class="my-3">
                <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseSearch"
                    aria-expanded="false" aria-controls="collapseSearch">
                    Filter Search
                </button>
            </div>
        </div>


        <div class="collapse" id="collapseSearch">
            <div class="card card-body mt-3">
                <h6 class="mb-3 font-weight-bold text-primary">Search Filter</h6>
                <form action="/asset-parent/search/{{ $assetGroup->id }}" method="get">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="search_date_before">Date</label>
                            <div class="form-group d-flex">
                                <input type="date" class="form-control form-control-sm" id="search_date_before"
                                    name="search_date_before" value="{{ request('search_date_before') }}">
                            </div>
                            <div class="form-group d-flex">
                                <input type="date" class="form-control form-control-sm" id="search_date_after"
                                    name="search_date_after" value="{{ request('search_date_after') }}">
                            </div>
                        </div>
                        @can('superadmin')
                            <div class="col-md-6 mb-3">
                                <label for="sbu_search_id">SBU</label>
                                <select class="form-control form-control-sm @error('sbu_search_id') is-invalid @enderror"
                                    id="sbu_search_id" name="sbu_search_id">
                                    <option value="">Select SBU</option>
                                    @foreach ($SBUs as $sb)
                                        <option value="{{ $sb->id }}"
                                            {{ request('sbu_search_id') == $sb->id ? 'selected' : '' }}>
                                            {{ $sb->sbu_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endcan
                        <div class="col-md-6 mb-3">
                            <label for="search_condition">Condition</label>
                            <select class="form-control form-control-sm @error('search_condition') is-invalid @enderror"
                                name="search_condition" id="search_condition">
                                <option value=""></option>
                                <option class="text-success" value="1"
                                    {{ request('search_condition') == 1 ? 'selected' : '' }}>
                                    Baik
                                </option>
                                <option class="text-warning" value="2"
                                    {{ request('search_condition') == 2 ? 'selected' : '' }}>
                                    Kurang
                                </option>
                                <option class="text-danger" value="3"
                                    {{ request('search_condition') == 3 ? 'selected' : '' }}>
                                    Rusak
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <button type="submit" class="btn btn-primary rounded text-xs">
                                Find <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="collapse" id="collapseExample">
            <div class="card card-body mt-3">
                <h6 class="mb-3 font-weight-bold text-primary">Export Filter</h6>
                <form action="/asset-export/all" method="get">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="date_before">Date</label>
                            <div class="form-group d-flex">
                                <input type="date" class="form-control form-control-sm" id="date_before"
                                    name="date_before" value="{{ request('date_before') }}">
                            </div>
                            <div class="form-group d-flex">
                                <input type="date" class="form-control form-control-sm" id="date_after" name="date_after"
                                    value="{{ request('date_after') }}">
                            </div>
                        </div>
                        @can('superadmin')
                            <div class="col-md-6">
                                <label for="sbu">SBU</label>
                                <select class="form-control form-control-sm @error('sbu') is-invalid @enderror" name="sbu"
                                    id="sbu">
                                    <option value=""></option>
                                    @foreach ($SBUs as $sbu_search)
                                        <option value="{{ $sbu_search->id }}"
                                            {{ request('sbu') == $sbu_search->id ? 'selected' : '' }}>
                                            {{ $sbu_search->sbu_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endcan
                        <div class="col-md-6 mb-3">
                            <label for="export_condition">Condition</label>
                            <select class="form-control form-control-sm @error('export_condition') is-invalid @enderror"
                                name="export_condition" id="export_condition">
                                <option value=""></option>
                                <option class="text-success" value="1"
                                    {{ request('export_condition') == 1 ? 'selected' : '' }}>
                                    Baik
                                </option>
                                <option class="text-warning" value="2"
                                    {{ request('export_condition') == 2 ? 'selected' : '' }}>
                                    Kurang
                                </option>
                                <option class="text-danger" value="3"
                                    {{ request('export_condition') == 3 ? 'selected' : '' }}>
                                    Rusak
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <button type="submit" class="btn btn-success rounded text-xs">
                                Generate <i class="fas fa-file-excel"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List group</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Asset Name</th>
                                <th>SBU</th>
                                <th>Purchase Date</th>
                                <th>Purchase Value</th>
                                <th>Penanggung Jawab</th>
                                <th>Condition</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assets as $asset)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{ $asset->asset_name }}</td>
                                    <td>{{ $asset->sbu->sbu_name ?? '' }}</td>
                                    <td class="block">{{ createDate($asset->pcs_date)->format('d F Y') }}</td>
                                    <td class="block">{{ rupiah($asset->pcs_value) }}</td>
                                    <td>{{ $asset->employee->name ?? '-' }}</td>
                                    <td>
                                        {{ $asset->condition == 1 ? 'Baik' : ($asset->condition == 2 ? 'Kurang' : 'Rusak') }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <a title="Asset Detail" href="/asset-parent/docs/{{ $asset->id }}"
                                                    class="btn btn-outline-dark btn-sm">Detail</a>
                                            </div>
                                            <div>
                                                <a title="Edit Data" href="/asset-parent/{{ $asset->id }}/edit"
                                                    class="btn btn-outline-dark btn-sm">Edit</a>
                                            </div>
                                            <div>
                                                <form action="/asset-parent/{{ $asset->id }}" method="post"
                                                    id="deleteForm">
                                                    @csrf
                                                    @method('delete')
                                                    <button title="Delete Data" class="btn btn-outline-danger btn-sm"
                                                        onclick="return false" id="deleteButton"
                                                        data-id="{{ $asset->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Modal -->
    <div class="modal fade" id="addNewRecord" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="addNewRecordLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-gradient-dark">
                    <h5 class="modal-title text-white" id="addNewRecordLabel">Form - Add New Assets</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/asset-parent" method="POST" id="formAdd" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="asset_name">Asset Name</label>
                                <input type="text" class="form-control @error('asset_name') is-invalid @enderror"
                                    name="asset_name" id="asset_name" value="{{ old('asset_name') }}"
                                    autocomplete="off" autofocus>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Asset Group</label>
                                <input type="hidden" name="asset_group_id" value="{{ $assetGroup->id }}" readonly>
                                <input type="text" class="form-control not-allowed"
                                    value="{{ $assetGroup->asset_group_name }}" disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="asset_code">Asset Code</label>
                                <input type="text" class="form-control @error('asset_code') is-invalid @enderror"
                                    name="asset_code" id="asset_code" value="{{ old('asset_code') }}">

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="condition">Asset Condition</label>
                                <select class="form-control @error('condition') is-invalid @enderror" name="condition"
                                    id="condition">
                                    <option value=""></option>
                                    <option class="text-success" value="1"
                                        {{ old('condition') == 1 ? 'selected' : '' }}>
                                        Baik
                                    </option>
                                    <option class="text-warning" value="2"
                                        {{ old('condition') == 2 ? 'selected' : '' }}>
                                        Kurang
                                    </option>
                                    <option class="text-danger" value="3"
                                        {{ old('condition') == 3 ? 'selected' : '' }}>
                                        Rusak
                                    </option>
                                </select>
                            </div>
                            @can('superadmin')
                                <div class="col-md-6 mb-3">
                                    <label for="sbu_id">SBU</label>
                                    <select class="form-control @error('sbu_id') is-invalid @enderror" name="sbu_id"
                                        id="sbu_id">
                                        <option value=""></option>
                                        @foreach ($SBUs as $sbu)
                                            <option value="{{ $sbu->id }}"
                                                {{ old('sbu_id') == $sbu->id ? 'selected' : '' }}>
                                                {{ $sbu->sbu_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endcan
                            <div class="col-md-6 mb-3">
                                <label for="location">Asset Location</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                    name="location" value="{{ old('location') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="emp_id">Penanggung Jawab</label>
                                <select class="form-control @error('emp_id') is-invalid @enderror" name="emp_id"
                                    id="emp_id">
                                    <option value=""></option>
                                    @foreach ($employees as $emp)
                                        <option value="{{ $emp->id }}"
                                            {{ old('emp_id') == $emp->id ? 'selected' : '' }}>
                                            {{ $emp->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="asset_no">No. (Pol/Rumah/Seri)</label>
                                <input type="text" class="form-control @error('asset_no') is-invalid @enderror"
                                    name="asset_no" id="asset_no" value="{{ old('asset_no') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sdb_id">SDB</label>
                                <select class="form-control @error('sdb_id') is-invalid @enderror" name="sdb_id"
                                    id="sdb_id">
                                    <option value=""></option>
                                    @foreach ($SDBs as $sdb)
                                        <option value="{{ $sdb->id }}"
                                            {{ old('sdb_id') == $sdb->id ? 'selected' : '' }}>
                                            {{ $sdb->sdb_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="pcs_date">Purchase Date</label>
                                <input type="date" class="form-control @error('pcs_date') is-invalid @enderror"
                                    name="pcs_date" id="pcs_date" value="{{ old('pcs_date') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pcs_value">Purchase Value</label>
                                <input type="text"
                                    class="form-control currency @error('pcs_value') is-invalid @enderror"
                                    name="pcs_value" id="pcs_value" value="{{ old('pcs_value') }}" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="desc">Description</label>
                                <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" cols="10"
                                    rows="5">{{ old('desc') }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Asset Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input  @error('image') is-invalid @enderror"
                                        name="image" id="imageFileInput" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" value="1" name="check" id="check">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnSubmit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- Page level plugins -->
    <script src="/assets/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/template/vendor/selectize/selectize.js"></script>
    <script src="/js/jquery.mask.min.js"></script>
    <script>
        let btnSubmit = $('#btnSubmit'),
            form = $('#formAdd'),
            formDelete = $('#deleteForm');

        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $("#emp_id").selectize({
            create: false,
            sortField: "text",
        });

        $("#sbu_id").selectize({
            create: false,
            sortField: "text",
        });

        $('.currency').mask('000.000.000.000', {
            reverse: true
        });

        $('#imageFileInput').on('change', function(e) {
            var fileName = $(this).val();
            $(this).next('.custom-file-label').html(e.target.files[0].name);
        })

        btnSubmit.click(function() {
            $(this).prop('disabled', true);
            form.submit();
        });

        $(document).on('click', '#deleteButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDelete.attr('action', `/asset-parent/${id}`)
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    formDelete.submit();
                }
            })
        });
    </script>

    @if ($errors->any())
        <script>
            $('#addNewRecord').modal('show');
        </script>
    @endif
@endpush
