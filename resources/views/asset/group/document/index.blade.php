@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('title', 'GA | Document Type')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Document Type</h1> --}}

        <div class="my-4">
            <div class="mb-3">
                <h6 class="text-muted">Add new record</h6>
            </div>
            <form action="/document-group" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <input name="document_group_name" type="text"
                            class="form-control @error('document_group_name') is-invalid @enderror"
                            value="{{ old('document_group_name') }}" autocomplete="off" autofocus>
                        @error('document_group_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Type</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documentGroup as $group)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $group->document_group_name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <a title="Edit Data" href="/document-group/{{ $group->id }}/edit"
                                                    class="btn btn-outline-dark text-xs">Edit</a>
                                            </div>
                                            <div>
                                                <form action="/document-group/{{ $group->id }}" method="post"
                                                    id="deleteForm">
                                                    @csrf
                                                    @method('delete')
                                                    <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                        onclick="return false" id="deleteButton"
                                                        data-id="{{ $group->id }}">
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
@endsection
@push('scripts')
    <!-- Page level plugins -->
    <script src="/assets/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        let formDelete = $('#deleteForm');

        $(document).on('click', '#deleteButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDelete.attr('action', `/document-group/${id}`)
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
