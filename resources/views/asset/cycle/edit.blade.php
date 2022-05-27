@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('title', 'GA | Edit Cycle')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Cycle</h1>

        <div class="my-4">
            <form action="/cycle/{{ $cycle->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cycle_name">Cycle Name</label>
                            <input name="cycle_name" type="text"
                                class="form-control @error('cycle_name') is-invalid @enderror" placeholder="Cycle Name"
                                value="{{ old('cycle_name', $cycle->cycle_name) }}" autocomplete="off" autofocus>
                            @error('cycle_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cycle_name">Cycle Qty</label>
                            <input name="qty" type="number" class="form-control @error('qty') is-invalid @enderror"
                                placeholder="Cycle Qty" value="{{ old('qty', $cycle->qty) }}" autocomplete="off">
                            @error('qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cycle_type">Cycle Type</label>
                            <select class="form-control  @error('cycle_type') is-invalid @enderror" id="cycle_type"
                                name="cycle_type">
                                <option value="">Cycle Type</option>
                                <option value="D" {{ old('cycle_type', $cycle->cycle_type) == 'D' ? 'selected' : '' }}>Day
                                </option>
                                <option value="M" {{ old('cycle_type', $cycle->cycle_type) == 'M' ? 'selected' : '' }}>
                                    Month</option>
                                <option value="Y" {{ old('cycle_type', $cycle->cycle_type) == 'Y' ? 'selected' : '' }}>
                                    Year
                                </option>
                            </select>
                            @error('cycle_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="/cycle" class="btn btn-secondary btn-sm mr-2">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary">
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
                                    <th>Name</th>
                                    <th>Days</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cycles as $c)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $c->cycle_name }}</td>
                                        <td>{{ $c->qty }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <div>
                                                    <a title="Edit Data" href="/cycle/{{ $c->id }}/edit"
                                                        class="btn btn-outline-dark text-xs">Edit</a>
                                                </div>
                                                <div>
                                                    <form action="/cycle/{{ $c->id }}" method="post"
                                                        id="deleteForm">
                                                        @csrf
                                                        @method('delete')
                                                        <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                            onclick="return false" id="deleteButton"
                                                            data-id="{{ $c->id }}">
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
            formDelete.attr('action', `/cycle/${id}`)
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
