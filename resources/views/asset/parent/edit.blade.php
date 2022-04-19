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
                <h1 class="h3text-gray-800 flex-grow-1">Edit Assets | {{ $asset->asset_name }}</h1>
            </div>

            <a href="/asset-parent" class="btn btn-secondary btn-sm mr-2" data-dismiss="modal">
                <i class="fas fa-arrow-left"></i> Asset
            </a>
            <a href="/asset-group/{{ $asset->asset_group_id }}" class="btn btn-dark btn-sm" data-dismiss="modal">
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
                        <input type="text" class="form-control @error('asset_name') is-invalid @enderror" name="asset_name"
                            id="asset_name" value="{{ old('asset_name', $asset->asset_name) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Asset Group</label>
                        <input type="hidden" name="asset_group_id" value="{{ $asset->asset_group_id }}" readonly>
                        <input type="text" class="form-control not-allowed" value="{{ $asset->group->asset_group_name }}"
                            disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="asset_code">Asset Code</label>
                        <input type="text" class="form-control @error('asset_code') is-invalid @enderror" name="asset_code"
                            id="asset_code" value="{{ old('asset_code', $asset->asset_code) }}">
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="position">Asset Position</label>
                        <input type="text" class="form-control @error('position') is-invalid @enderror" name="position"
                            value="{{ old('position', $asset->position) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="asset_no">No. (Pol/Rumah/Seri)</label>
                        <input type="text" class="form-control @error('asset_no') is-invalid @enderror" name="asset_no"
                            id="asset_no" value="{{ old('asset_no', $asset->asset_no) }}">
                        </select>
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
                            name="pcs_value" id="pcs_value" value="{{ old('pcs_value', $asset->pcs_value) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="apr_date">Aprraisal Date</label>
                        <input type="date" class="form-control @error('apr_date') is-invalid @enderror" name="apr_date"
                            id="apr_date" value="{{ old('apr_date', $asset->apr_date) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="apr_value">Aprraisal Value</label>
                        <input type="text" class="form-control currency @error('apr_value') is-invalid @enderror"
                            name="apr_value" value="{{ old('apr_value', $asset->apr_value) }}">
                    </div>
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
                            <input type="file" class="custom-file-input  @error('image') is-invalid @enderror" name="image"
                                id="imageFileInput" accept="image/*">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                </div>
                <button type="button" id="btnSubmit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
        <div class="mt-5 mb-3">
            <button id="collapseBtn" class="btn btn-outline-dark text-xs rounded-pill" type="button" data-toggle="collapse"
                data-target="#collapseTable" aria-expanded="false" aria-controls="collapseTable">
                Show Table
            </button>
        </div>

        <div class="collapse" id="collapseTable">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List assets</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Group</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assets as $parent)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $parent->group->asset_group_name }}</td>
                                        <td>{{ $parent->asset_name }}</td>
                                        <td>{{ $parent->desc }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <div>
                                                    <a title="Asset Documents"
                                                        href="/asset-parent/docs/{{ $parent->id }}"
                                                        class="btn btn-outline-dark text-xs">Documents</a>
                                                </div>
                                                <div>
                                                    <a title="Edit Data" href="/asset-parent/{{ $parent->id }}/edit"
                                                        class="btn btn-outline-dark text-xs">Edit</a>
                                                </div>
                                                <div>
                                                    <form action="/asset-parent/{{ $parent->id }}" method="post"
                                                        id="deleteForm">
                                                        @csrf
                                                        @method('delete')
                                                        <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                            onclick="return false" id="deleteButton"
                                                            data-id="{{ $parent->id }}">
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
