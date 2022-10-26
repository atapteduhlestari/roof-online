@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Edit Asset')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex align-items-center mb-3">
            <div class="flex-grow-1">
                <h1 class="h3 text-gray-800 flex-grow-1">Edit Assets | {{ $asset->asset_name }}</h1>
            </div>

            <a href="/asset-parent" class="btn btn-secondary btn-sm mr-2">
                <i class="fas fa-arrow-left"></i> Asset
            </a>
            <a href="/asset-group/{{ $asset->asset_group_id }}" class="btn btn-dark btn-sm">
                <i class="fas fa-external-link-square-alt"></i> Group
            </a>
        </div>

        <div class="my-4">
            <form action="/asset-parent/{{ $asset->id }}" method="POST" id="formAdd" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="asset_name">Asset Name</label>
                        <input type="text" class="form-control @error('asset_name') is-invalid @enderror"
                            name="asset_name" id="asset_name" value="{{ old('asset_name', $asset->asset_name) }}"
                            autocomplete="off" autofocus>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Asset Group</label>
                        <input type="hidden" name="asset_group_id" value="{{ $asset->asset_group_id }}" readonly>
                        <input type="text" class="form-control not-allowed" value="{{ $asset->group->asset_group_name }}"
                            disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="asset_code">Asset Code</label>
                        <input type="text" class="form-control @error('asset_code') is-invalid @enderror"
                            name="asset_code" id="asset_code" value="{{ old('asset_code', $asset->asset_code) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="condition">Asset Condition</label>
                        <select class="form-control @error('condition') is-invalid @enderror" name="condition"
                            id="condition">
                            <option value=""></option>
                            <option class="text-success" value="1"
                                {{ old('condition', $asset->condition) == 1 ? 'selected' : '' }}>
                                Baik
                            </option>
                            <option class="text-warning" value="2"
                                {{ old('condition', $asset->condition) == 2 ? 'selected' : '' }}>
                                Kurang
                            </option>
                            <option class="text-danger" value="3"
                                {{ old('condition', $asset->condition) == 3 ? 'selected' : '' }}>
                                Rusak
                            </option>
                        </select>
                    </div>
                    @can('superadmin')
                        <div class="col-md-6 mb-3">
                            <label for="sbu_id">SBU</label>
                            <select class="form-control @error('sbu_id') is-invalid @enderror" name="sbu_id" id="sbu_id">
                                <option value=""></option>
                                @foreach ($SBUs as $sbu)
                                    <option value="{{ $sbu->id }}"
                                        {{ old('sbu_id', $asset->sbu_id) == $sbu->id ? 'selected' : '' }}>
                                        {{ $sbu->sbu_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endcan
                    <div class="col-md-6 mb-3">
                        <label for="location">Asset Location</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" name="location"
                            value="{{ old('location', $asset->location) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="emp_id">Penanggung Jawab</label>
                        <select class="form-control @error('emp_id') is-invalid @enderror" name="emp_id" id="emp_id">
                            <option value=""></option>
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}"
                                    {{ old('emp_id', $asset->emp_id) == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="asset_no">No. (Pol/Rumah/Seri)</label>
                        <input type="text" class="form-control @error('asset_no') is-invalid @enderror" name="asset_no"
                            id="asset_no" value="{{ old('asset_no', $asset->asset_no) }}">
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sdb_id">SDB</label>
                            <select class="form-control @error('sdb_id') is-invalid @enderror" name="sdb_id"
                                id="sdb_id">
                                <option value=""></option>
                                @foreach ($SDBs as $sdb)
                                    <option value="{{ $sdb->id }}"
                                        {{ old('sdb_id', $asset->sdb_id) == $sdb->id ? 'selected' : '' }}>
                                        {{ $sdb->sdb_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="pcs_date">Purchase Date</label>
                        <input type="date" class="form-control @error('pcs_date') is-invalid @enderror" name="pcs_date"
                            id="pcs_date" value="{{ old('pcs_date', $asset->pcs_date) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pcs_value">Purchase Value</label>
                        <input type="text" class="form-control currency @error('pcs_value') is-invalid @enderror"
                            name="pcs_value" id="pcs_value" value="{{ old('pcs_value', $asset->pcs_value) }}"
                            autocomplete="off">
                    </div>

                    {{-- <div class="col-md-6 mb-3">
                        <label for="apr_date">Appraisal Date</label>
                        <input type="date" class="form-control @error('apr_date') is-invalid @enderror" name="apr_date"
                            id="apr_date" value="{{ old('apr_date', $asset->apr_date) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="apr_value">Appraisal Value</label>
                        <input type="text" class="form-control currency @error('apr_value') is-invalid @enderror"
                            name="apr_value" value="{{ old('apr_value', $asset->apr_value) }}" autocomplete="off">
                    </div> --}}
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="desc">Description</label>
                        <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" cols="10"
                            rows="5">{{ old('desc', $asset->desc) }}</textarea>
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
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" id="btnSubmit" class="btn btn-sm btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@push('scripts')
    <!-- Page level plugins -->
    <script src="/assets/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/app/js/table.js"></script>
    <script src="/assets/template/vendor/selectize/selectize.js"></script>
    <script src="/js/jquery.mask.min.js"></script>
    <script>
        let btnSubmit = $('#btnSubmit'),
            form = $('#formAdd'),
            formDelete = $('#deleteForm');

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
@endpush
