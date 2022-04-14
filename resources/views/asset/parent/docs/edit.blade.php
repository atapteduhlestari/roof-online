@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('title', 'GA | Edit Docs')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Assets Edit | {{ $asset->asset_name }}</h1>

        <div class="my-4">
            <form action="/asset-parent/docs/update/{{ $asset->id }}/{{ $child->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Document Name</label>
                        <div class="form-group">
                            <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Document Name" value="{{ old('name', $child->name) }}" autocomplete="off"
                                autofocus>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="desc" id="desc" rows="5"
                                placeholder="Description">{{ old('desc', $child->desc) }}</textarea>
                            @error('desc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>
                </div>
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
                    <h6 class="m-0 font-weight-bold text-primary">List documents</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($children as $child)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $child->name }}</td>
                                        <td>{{ $child->desc }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <div>
                                                    <a title="Edit Data"
                                                        href="/asset-parent/docs/edit/{{ $asset->id }}/{{ $child->id }}"
                                                        class="btn btn-outline-dark text-xs">Edit</a>
                                                </div>
                                                <div>
                                                    <form
                                                        action="/asset-parent/docs/delete/{{ $asset->id }}/{{ $child->id }}"
                                                        method="POST" id="deleteForm">
                                                        @csrf
                                                        @method('delete')
                                                        <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                            onclick="return false" id="deleteButton"
                                                            data-id="{{ $child->id }}"
                                                            data-asset_id="{{ $asset->id }}">
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
    <script>
        let formDelete = $('form#deleteForm');

        $(document).on('click', '#deleteButton', function(e) {
            e.preventDefault();
            let assetId = $(this).data('asset_id');
            let id = $(this).data('id');
            formDelete.attr('action', `/asset-parent/docs/delete/${assetId}/${id}`)
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
