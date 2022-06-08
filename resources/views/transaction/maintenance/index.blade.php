@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Maintenance Transaction')
@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Transaction | Maintenance</h1>

        <div class="d-flex">
            <div class="my-3 flex-grow-1">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addNewRecord">
                    Add <i class="fas fa-plus-circle"></i>
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
            <form action="/trn-maintenance" method="get">
                <div class="row">
                    <div class="col-md-6">
                        <label for="trn_date">Date</label>
                        <div class="form-group d-flex">
                            <input type="month" class="form-control" id="trn_date" name="trn_date" value="">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="asset_search_id">Assets</label>
                        <select class="form-control @error('asset_search_id') is-invalid @enderror" id="asset_search_id"
                            name="asset_search_id">
                            <option value="">Select Assets</option>
                            @foreach ($assets as $ac)
                                <option value="{{ $ac->id }}"
                                    {{ old('asset_search_id') == $ac->id ? 'selected' : '' }}>
                                    {{ $ac->asset_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-outline-dark ml-1 rounded text-xs">
                    Find <i class="fas fa-search"></i>
                </button>
            </form>
        </div>


        <div class="card shadow mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Transaction</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Document No.</th>
                                <th>Type</th>
                                <th>Due Date</th>
                                <th>File</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trnMaintenances as $trn)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trn->trn_no }}</td>
                                    <td>{{ $trn->maintenance->name }}</td>
                                    <td>{{ createDate($trn->trn_date)->format('d F Y') }}</td>
                                    <td>
                                        @if ($trn->file)
                                            <a title="download file" href="/trn-maintenance/download/{{ $trn->id }}"
                                                class="text-dark">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <a title="Detail Data" href="/trn-maintenance/{{ $trn->id }}"
                                                    class="btn btn-outline-dark text-xs">
                                                    <i class="fas fa-search-plus"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <a title="Edit Data" href="/trn-maintenance/{{ $trn->id }}/edit"
                                                    class="btn btn-outline-dark text-xs">Edit</a>
                                            </div>
                                            <div>
                                                <form action="/trn-maintenance/{{ $trn->id }}" method="post"
                                                    id="deleteForm">
                                                    @csrf
                                                    @method('delete')
                                                    <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                        onclick="return false" id="deleteButton"
                                                        data-id="{{ $trn->id }}">
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

    <!-- Modal Assets Parent -->
    <div class="modal fade" id="addNewRecord" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="addNewRecordLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient-dark">
                    <h5 class="modal-title text-white" id="addNewRecordLabel">Form Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/trn-maintenance" method="POST" id="formTrnmaintenance" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="asset_id">Select Asset</label>
                                <select class="form-control @error('asset_id') is-invalid @enderror" id="asset_id"
                                    name="asset_id">
                                    <option value=""></option>
                                    @foreach ($assets as $asset)
                                        <option value="{{ $asset->id }}"
                                            {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                            {{ $asset->asset_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="maintenance_id">
                                    Select Maintenance
                                    <a href="/maintenance" class="text-xs">Add list</a>
                                </label>
                                <select class="form-control @error('maintenance_id') is-invalid @enderror"
                                    id="maintenance_id" name="maintenance_id">
                                    <option value=""></option>
                                    @foreach ($maintenances as $maintenance)
                                        <option value="{{ $maintenance->id }}"
                                            {{ old('maintenance_id') == $maintenance->id ? 'selected' : '' }}>
                                            {{ $maintenance->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="trn_start_date">Start Date</label>
                                <input type="date" class="form-control @error('trn_start_date') is-invalid @enderror"
                                    name="trn_start_date" value="{{ old('trn_start_date') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="trn_date">Due Date</label>
                                <input type="date" class="form-control @error('trn_date') is-invalid @enderror"
                                    name="trn_date" value="{{ old('trn_date') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="trn_value_plan">Cost Plan</label>
                                <input type="text"
                                    class="form-control currency @error('trn_value_plan') is-invalid @enderror"
                                    name="trn_value_plan" value="{{ old('trn_value_plan') }}" autocomplete="off">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="trn_value">Cost Realization</label>
                                <input type="text" class="form-control currency @error('trn_value') is-invalid @enderror"
                                    name="trn_value" value="{{ old('trn_value') }}" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="pemohon">Pemohon</label>
                                <select class="form-control @error('pemohon') is-invalid @enderror" name="pemohon"
                                    id="pemohon">
                                    <option value="">Pemohon</option>
                                    @foreach ($employees as $pemohon)
                                        <option value="{{ $pemohon->name }}"
                                            {{ old('pemohon') == $pemohon->name ? 'selected' : '' }}>
                                            {{ $pemohon->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pembuat">Pembuat</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="penyetuju">Menyetujui</label>
                                <select class="form-control @error('penyetuju') is-invalid @enderror" name="penyetuju"
                                    id="penyetuju">
                                    <option value="">Select Employees</option>
                                    @foreach ($employees as $penyetuju)
                                        <option value="{{ $penyetuju->name }}"
                                            {{ old('penyetuju') == $penyetuju->name ? 'selected' : '' }}>
                                            {{ $penyetuju->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="trn_desc">Description</label>
                                    <textarea class="form-control" id="trn_desc" name="trn_desc" cols="10" rows="5">{{ old('trn_desc') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input  @error('file') is-invalid @enderror"
                                        name="file" id="fileInput">
                                    <label class="custom-file-label" for="file">Choose file</label>
                                </div>
                            </div>
                        </div>

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
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $('.currency').mask('000.000.000.000', {
            reverse: true
        });

        let form = $('#formTrnmaintenance'),
            btnSubmit = $('#btnSubmit');

        $("#asset_search_id").selectize({
            create: false,
            sortField: "text",
        });

        $("#asset_id").selectize({
            create: false,
            sortField: "text",
        });

        $("#pemohon").selectize({
            create: false,
            sortField: "text",
        });

        $("#penyetuju").selectize({
            create: false,
            sortField: "text",
        });

        $("#maintenance_id").selectize({
            create: false,
            sortField: "text",
        });

        $('#fileInput').on('change', function(e) {
            var fileName = $(this).val();
            $(this).next('.custom-file-label').html(e.target.files[0].name);
        });

        btnSubmit.click(function() {
            $(this).prop('disabled', true);
            form.submit();
        });

        let formDelete = $('#deleteForm');

        $(document).on('click', '#deleteButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDelete.attr('action', `/trn-maintenance/${id}`)
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
