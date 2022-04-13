@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('title', 'GA | Edit Renewal')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Renewal Edit | {{ $renewal->name }}</h1>

        <div class="my-4">
            <form action="/renewal/{{ $renewal->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Renewal Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Renewal Name" value="{{ old('name', $renewal->name) }}" autocomplete="off"
                            autofocus>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_doc">Document No.</label>
                            <input type="text" class="form-control @error('no_doc') is-invalid @enderror" name="no_doc"
                                placeholder="Document No." value="{{ old('no_doc', $renewal->no_doc) }}">
                            @error('no_doc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cycle_id">Cycle</label>
                            <select class="form-control @error('cycle_id') is-invalid @enderror" name="cycle_id"
                                id="cycle_id">
                                <option value="">Select Cycle</option>
                                @foreach ($cycles as $cycle)
                                    <option value="{{ $cycle->id }}"
                                        {{ old('cycle_id', $renewal->cycle_id) == $cycle->id ? 'selected' : '' }}>
                                        {{ $cycle->cycle_name }}</option>
                                @endforeach
                            </select>
                            @error('cycle_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
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
                    <h6 class="m-0 font-weight-bold text-primary">List record</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($renewals as $renewal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $renewal->no_doc }}</td>
                                        <td>{{ $renewal->name }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <div>
                                                    <a title="Edit Data" href="/renewal/{{ $renewal->id }}/edit"
                                                        class="btn btn-outline-dark text-xs">Edit</a>
                                                </div>
                                                <div>
                                                    <form action="/renewal/{{ $renewal->id }}" method="post"
                                                        id="deleteForm">
                                                        @csrf
                                                        @method('delete')
                                                        <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                            onclick="return false" id="deleteButton"
                                                            data-id="{{ $renewal->id }}">
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
        let formDelete = $('#deleteForm');

        $(document).on('click', '#deleteButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDelete.attr('action', `/renewal/${id}`)
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
