@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Loan Transaction')
@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-0 text-gray-800">Transaction - Loan</h1>

        <div class="d-flex">
            <div class="my-3 flex-grow-1">
                <button id="btnAsset" class="btn btn-primary" type="button" data-toggle="modal" data-target="#addNewRecord">
                    Loan Asset
                </button>

                <button id="btnDoc" class="btn btn-info" type="button" data-toggle="modal" data-target="#addNewRecord">
                    Loan Document
                </button>
            </div>
        </div>

        <div class="card shadow mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Table Data</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>SBU</th>
                                <th>Start Date</th>
                                <th>Due Date</th>
                                <th>Returned</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $loan->loan_type ? $loan->asset->asset_name : $loan->document->doc_name ?? '' }}
                                    </td>
                                    <td>{{ $loan->loan_type ? 'Asset' : 'Document' }}</td>
                                    <td>{{ $loan->sbu->sbu_name }}</td>
                                    <td class="block">{{ createDate($loan->loan_start_date)->format('d F Y') }}</td>
                                    <td class="block">{{ createDate($loan->loan_due_date)->format('d F Y') }}</td>
                                    <td class="block">
                                        {{ $loan->date ? createDate($loan->loan_date)->format('d F Y') : '-' }}
                                    </td>
                                    <td>
                                        <span class="  {{ $loan->loan_status ? 'text-success' : 'text-danger' }}">
                                            {{ $loan->loan_status ? 'returned' : 'on loan' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <a title="Detail Data" href="/loan/{{ $loan->id }}"
                                                    class="btn btn-outline-dark text-xs">
                                                    <i class="fas fa-search-plus"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <a title="Edit Data" href="/loan/{{ $loan->id }}/edit"
                                                    class="btn btn-outline-dark text-xs">Edit</a>
                                            </div>
                                            <div>
                                                <form action="/loan/{{ $loan->id }}" method="post" id="deleteForm">
                                                    @csrf
                                                    @method('delete')
                                                    <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                        onclick="return false" id="deleteButton"
                                                        data-id="{{ $loan->id }}">
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
                    <h5 class="modal-title text-white" id="addNewRecordLabel">Form Loan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/loan" method="POST" id="formLoan">
                        @csrf
                        <div class="row">
                            <input id="loan_type" name="loan_type" type="hidden" value="">
                            <div class="col-md-12 mb-3" id="assetSelectForm">
                                <label for="asset_id">Select Asset</label>
                                <select class="form-control @error('asset_id') is-invalid @enderror" id="asset_id"
                                    name="asset_id">
                                    <option value=""></option>
                                    @foreach ($assets as $asset)
                                        <option value="{{ $asset->id }}"
                                            {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                            {{ $asset->sbu->sbu_name ?? '' }} | {{ $asset->asset_name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 mb-3" id="docSelectForm">
                                <label for="asset_child_id">Select Document</label>
                                <select class="form-control @error('asset_child_id') is-invalid @enderror"
                                    id="asset_child_id" name="asset_child_id">
                                    <option value=""></option>
                                    @foreach ($assetChild as $doc)
                                        <option value="{{ $doc->id }}"
                                            {{ old('asset_child_id') == $doc->id ? 'selected' : '' }}>
                                            {{ $doc->doc_name }} - {{ $doc->parent->asset_name ?? '' }} |
                                            {{ $doc->sbu->sbu_name ?? '' }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="loan_start_date">Start Date</label>
                                <input type="date" class="form-control @error('loan_start_date') is-invalid @enderror"
                                    name="loan_start_date" value="{{ old('loan_start_date') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="loan_due_date">Due Date</label>
                                <input type="date" class="form-control @error('loan_due_date') is-invalid @enderror"
                                    name="loan_due_date" value="{{ old('loan_due_date') }}">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="peminjam">Peminjam</label>
                                <select class="form-control @error('peminjam') is-invalid @enderror" name="peminjam"
                                    id="peminjam">
                                    <option value="">Select Employees</option>
                                    @foreach ($employees as $peminjam)
                                        <option value="{{ $peminjam->name }}"
                                            {{ old('peminjam') == $peminjam->name ? 'selected' : '' }}>
                                            {{ $peminjam->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pembuat">Pembuat</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sbu_id">SBU</label>
                                <select class="form-control @error('sbu_id') is-invalid @enderror" name="sbu_id"
                                    id="sbu_id">
                                    <option value="">Select SBU</option>
                                    @foreach ($SBUs as $sbu)
                                        <option value="{{ $sbu->id }}"
                                            {{ old('sbu_id') == $sbu->id ? 'selected' : '' }}>
                                            {{ $sbu->sbu_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" cols="10" rows="5">{{ old('description') }}</textarea>
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
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $('#btnAsset').click(function() {
            $('#docSelectForm').hide();
            $('#assetSelectForm').show();
            $('#loan_type').val(1);
        })

        $('#btnDoc').click(function() {
            $('#assetSelectForm').hide();
            $('#docSelectForm').show();
            $('#loan_type').val(0);
        })

        let form = $('#formLoan'),
            btnSubmit = $('#btnSubmit');
        $("#asset_child_id").selectize({
            create: false,
            sortField: "text",
        });

        $("#asset_id").selectize({
            create: false,
            sortField: "text",
        });

        $("#sbu_id").selectize({
            create: false,
            sortField: "text",
        });

        $("#peminjam").selectize({
            create: false,
            sortField: "text",
        });

        btnSubmit.click(function() {
            $(this).prop('disabled', true);
            form.submit();
        });

        let formDelete = $('#deleteForm');

        $(document).on('click', '#deleteButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDelete.attr('action', `/loan/${id}`)
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
