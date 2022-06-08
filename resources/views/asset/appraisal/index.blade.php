@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Appraisal')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Appraisal</h1>

        <div class="my-4">
            <!-- Button trigger modal -->
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addNewRecord">
                Add <i class="fas fa-plus-circle"></i>
            </button>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List record</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Asset</th>
                                <th>Date</th>
                                <th>Value</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appraisals as $appraisal)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $appraisal->asset->asset_name }}</td>
                                    <td>{{ createDate($appraisal->apr_date)->format('d M Y') }}
                                    </td>
                                    <td>
                                        {{ rupiah($appraisal->apr_value) }}</td>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <a title="Edit Data" href="/appraisal/{{ $appraisal->id }}/edit"
                                                    class="btn btn-outline-dark btn-sm">Edit</a>
                                            </div>
                                            <div>
                                                <form action="/appraisal/{{ $appraisal->id }}" method="post"
                                                    id="deleteForm">
                                                    @csrf
                                                    @method('delete')
                                                    <button title="Delete Data" class="btn btn-outline-danger btn-sm"
                                                        onclick="return false" id="deleteButton"
                                                        data-id="{{ $appraisal->id }}">
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

    <div class="modal fade" id="addNewRecord" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="addNewRecordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-gradient-dark">
                    <h5 class="modal-title text-white" id="addNewRecordLabel">Form - Add Appraisal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/appraisal" method="POST" id="formAdd">
                        @csrf
                        <div class="mb-3">
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
                        <div class="mb-3">
                            <label for="apr_date">Date</label>
                            <input type="date" class="form-control @error('apr_date') is-invalid @enderror" name="apr_date"
                                value="{{ old('apr_date') }}">
                        </div>

                        <div class="mb-3">
                            <label for="apr_value">Cost</label>
                            <input type="text" class="form-control currency @error('apr_value') is-invalid @enderror"
                                name="apr_value" value="{{ old('apr_value') }}" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <button type="button" id="btnSubmit" class="btn btn-primary">Submit</button>
                        </div>
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

        $("#asset_id").selectize({
            create: false,
            sortField: "text",
        });

        let btnSubmit = $('#btnSubmit'),
            form = $('#formAdd'),
            formDelete = $('#deleteForm');

        btnSubmit.click(function() {
            $(this).prop('disabled', true);
            form.submit();
        });

        $(document).on('click', '#deleteButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDelete.attr('action', `/appraisal/${id}`)
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
