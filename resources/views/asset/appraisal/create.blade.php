@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Appraisal Transaction')
@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex align-items-center mb-3">
            <div class="flex-grow-1">
                <h1 class="h3 mb-2 text-gray-800">Appraisal | {{ $asset->asset_name }}</h1>
            </div>
            <a href="/appraisal" class="btn btn-secondary btn-sm mr-2">
                <i class="fas fa-arrow-left"></i> Table Appraisal
            </a>
        </div>
        <button class="btn btn-sm btn-primary mb-3" type="button" data-toggle="collapse" data-target="#collapseExample"
            aria-expanded="false" aria-controls="collapseExample">
            Add new
        </button>
        <div class="collapse" id="collapseExample">
            <div class="mb-4">
                <form action="/appraisal" method="POST" id="formAppraisal">
                    @csrf
                    <input type="hidden" name="asset_id" value="{{ $asset->id }}">
                    <div class="col-md-6 mb-3">
                        <label>Asset</label>
                        <input type="text" class="form-control not-allowed" value="{{ $asset->asset_name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apr_date">Date</label>
                        <input type="date" class="form-control @error('apr_date') is-invalid @enderror" name="apr_date"
                            value="{{ old('apr_date') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="apr_value">Cost</label>
                        <input type="text" class="form-control currency @error('apr_value') is-invalid @enderror"
                            name="apr_value" value="{{ old('apr_value') }}" autocomplete="off">
                    </div>
                    <div class="col-md-6 mb-3">
                        <button type="button" id="btnSubmit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
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
                            @if (count($asset->appraisals) > 0)
                                @foreach ($asset->appraisals as $appraisal)
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
                            @else
                                <tr class="text-center">
                                    <td colspan="5">No Data Available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- Page level plugins -->
    <script src="/assets/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/js/jquery.mask.min.js"></script>
    <script>
        let btnSubmit = $('#btnSubmit'),
            form = $('#formAppraisal'),
            formDelete = $('#deleteForm');

        $('.currency').mask('000.000.000.000', {
            reverse: true
        });

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
@endpush
