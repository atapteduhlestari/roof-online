@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Storage Transaction')
@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Transaction | Storage</h1>
        <div class="my-3">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalAssetsParent">
                Add <i class="fas fa-plus-circle"></i>
            </button>
        </div>

        <div class="card shadow mb-4">
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
                                <th>Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trnStorages as $trn)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trn->trn_no }}</td>
                                    <td>{{ createDate($trn->trn_date)->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <a href="/trn-storage/{{ $trn->id }}" class="btn btn-sm btn-light">
                                                    <i class="fas fa-search-plus"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="/trn-storage/{{ $trn->id }}/edit"
                                                    class="btn btn-sm btn-info">Edit</a>
                                            </div>
                                            <div>
                                                <form action="/trn-storage/{{ $trn->id }}" method="post"
                                                    id="deleteForm">
                                                    @csrf
                                                    @method('delete')
                                                    <button title="Hapus Data" class="btn btn-sm btn-danger"
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
    <div class="modal fade" id="modalAssetsParent" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalAssetsParentLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAssetsParentLabel">Form Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/trn-storage" method="POST" id="formTrnStorage">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="asset_id">Assets</label>
                                <select class="form-control @error('asset_id') is-invalid @enderror" id="asset_id"
                                    name="asset_id">
                                    <option value="">Select Assets</option>
                                    @foreach ($assets as $asset)
                                        <option value="{{ $asset->id }}"
                                            {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                            {{ $asset->asset_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" id="docsCol">
                                <label for="asset_child_id">Docs</label>
                                <select name="asset_child_id" id="assetChildren" class="form-control"
                                    placeholder="Select Docs" disabled>
                                    <option value="">Select Docs</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="storage_id">Select Storage</label>
                                <select class="form-control @error('storage_id') is-invalid @enderror" id="storage_id"
                                    name="storage_id">
                                    <option value="">Select Storage</option>
                                    @foreach ($storages as $storage)
                                        <option value="{{ $storage->id }}"
                                            {{ old('storage_id') == $storage->id ? 'selected' : '' }}>
                                            {{ $storage->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="trn_date">Date</label>
                                <input type="date" class="form-control @error('trn_date') is-invalid @enderror"
                                    name="trn_date" value="{{ old('trn_date') }}">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="pelaksana">Pelaksana</label>
                                <select class="form-control @error('pelaksana') is-invalid @enderror" name="pelaksana"
                                    id="pelaksana">
                                    <option value="">Pelaksana</option>
                                    @foreach ($employees as $pelaksana)
                                        <option value="{{ $pelaksana->name }}"
                                            {{ old('pelaksana') == $pelaksana->name ? 'selected' : '' }}>
                                            {{ $pelaksana->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pemohon">Pemohon</label>
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
                        <div class="form-group mb-3">
                            <label for="trn_desc">Description</label>
                            <textarea class="form-control" id="trn_desc" name="trn_desc" cols="10" rows="5">{{ old('trn_desc') }}</textarea>
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
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        let assetChildren = $('#assetChildren'),
            appendDocs = $('#docsCol'),
            checkDocs = $('#check'),
            form = $('#formTrnStorage'),
            btnSubmit = $('#btnSubmit');

        $("#asset_id").selectize({
            create: false,
            sortField: "text",
        });

        $("#pelaksana").selectize({
            create: false,
            sortField: "text",
        });

        $("#penyetuju").selectize({
            create: false,
            sortField: "text",
        });

        $("#storage_id").selectize({
            create: false,
            sortField: "text",
        });

        $(document).on('change', '#asset_id', async function() {
            let id = $(this).val();
            if (id) {
                await $.getJSON(`/api/asset-parent/get-data/${id}`, function(res) {
                    assetChildren.prop('disabled', false);
                    assetChildren.empty().append($('<option>').text('Select Docs').val(''));

                    $.each(res, function(index, item) {
                        assetChildren.append($('<option>').text(item.name).val(item.id));
                    });
                });

                $(assetChildren).change(function() {
                    if ($(this).val() === "")
                        checkDocs.val(1)
                    else
                        checkDocs.val(0)
                })

            } else {
                checkDocs.val(1)
                assetChildren.prop('disabled', true);
                assetChildren.empty().append($('<option>').text('Select Docs').val(''));
            }
        });

        btnSubmit.click(function() {
            $(this).prop('disabled', true);
            form.submit();
        });

        let formDelete = $('#deleteForm');

        $(document).on('click', '#deleteButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDelete.attr('action', `/trn-storage/${id}`)
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
            $('#modalAssetsParent').modal('show');
        </script>
    @endif
@endpush
