@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Asset')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">All Documents</h1>
        <div class="my-4">
            <!-- Button trigger modal -->
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addNewRecord">
                Add <i class="fas fa-plus-circle"></i>
            </button>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Documents</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>No Doc</th>
                                <th>Due Date</th>
                                <th>Description</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($children as $child)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $child->doc_name }}
                                    </td>
                                    <td>{{ $child->doc_no }}</td>
                                    <td>{{ createDate($child->due_date)->format('d F Y') }}</td>
                                    <td>{{ $child->desc }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <form action="/trn-renewal/create">
                                                <input type="hidden" name="id" value="{{ $child->id }}" readonly>
                                                <button type="submit" class="btn btn-outline-dark btn-sm">
                                                    <i class="fas fa-file-signature"></i> Renewal
                                                </button>
                                            </form>
                                            <div>
                                                <a title="Edit Data"
                                                    href="/asset-parent/docs/edit/{{ $child->parent->id }}/{{ $child->id }}"
                                                    class="btn btn-outline-dark text-xs">Edit</a>
                                            </div>
                                            <div>
                                                <form
                                                    action="/asset-parent/docs/delete/{{ $child->parent->id }}/{{ $child->id }}"
                                                    method="POST" id="deleteDocForm">
                                                    @csrf
                                                    @method('delete')
                                                    <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                        onclick="return false" id="deleteDocButton"
                                                        data-id="{{ $child->id }}"
                                                        data-asset_id="{{ $child->parent->id }}">
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
                    <h5 class="modal-title text-white" id="addNewRecordLabel">Form - Add New Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/asset-child" method="POST" id="formAdd">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="doc_name">Document Name</label>
                                    <input name="doc_name" id="doc_name" type="text"
                                        class="form-control @error('doc_name') is-invalid @enderror"
                                        value="{{ old('doc_name') }}" autocomplete="off" autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="doc_no">Document No</label>
                                    <input name="doc_no" id="doc_no" type="text"
                                        class="form-control @error('doc_no') is-invalid @enderror"
                                        value="{{ old('doc_no') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="due_date">Due Date</label>
                                    <input name="due_date" id="due_date" type="date"
                                        class="form-control @error('due_date') is-invalid @enderror"
                                        value="{{ old('due_date') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="asset_id">Assets</label>
                                    <select class="form-control @error('asset_id') is-invalid @enderror" name="asset_id"
                                        id="asset_id">
                                        <option value=""></option>
                                        @foreach ($assets as $asset)
                                            <option value="{{ $asset->id }}"
                                                {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                                {{ $asset->asset_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
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
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="desc">Description</label>
                                    <textarea class="form-control  @error('desc') is-invalid @enderror" name="desc" id="desc" cols="30"
                                        rows="5">{{ old('desc') }}</textarea>
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

        let btnSubmit = $('#btnSubmit'),
            form = $('#formAdd'),
            formDelete = $('#deleteForm');

        $("#asset_id").selectize({
            create: false,
            sortField: "text",
        });

        btnSubmit.click(function() {
            $(this).prop('disabled', true);
            form.submit();
        });

        $(document).on('click', '#deleteButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDelete.attr('action', `/asset-child/${id}`)
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
