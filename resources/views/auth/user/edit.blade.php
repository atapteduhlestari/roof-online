@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | User Management')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">User Management</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit user</h6>
            </div>
            <div class="card-body">
                <form action="/user/{{ $user->id }}" method="POST" id="formAdd">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ old('name', $user->name) }}" autocomplete="off" autofocus>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sbu_id">SBU</label>
                            <select class="form-control @error('sbu_id') is-invalid @enderror" name="sbu_id"
                                id="sbu_id">
                                <option value=""></option>
                                @foreach ($SBUs as $sbu)
                                    <option value="{{ $sbu->id }}"
                                        {{ old('sbu_id', $user->sbu_id) == $sbu->id ? 'selected' : '' }}>
                                        {{ $sbu->sbu_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" id="username" value="{{ old('username', $user->username) }}"
                                autocomplete="off">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="active">Status</label>
                            <select class="form-control @error('active') is-invalid @enderror" name="active"
                                id="active">
                                <option value="" selected disabled>Select</option>
                                <option value="1" class="text-success"
                                    {{ old('active', $user->active) == 1 ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" class="text-danger"
                                    {{ old('active', $user->active) == false ? 'selected' : '' }}>Not active</option>

                            </select>
                        </div>
                    </div>
                    <a href="/user" class="btn btn-secondary" data-dismiss="modal">Back</a>
                    <button type="button" id="btnSubmit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@push('scripts')
    <!-- Page level plugins -->
    <script src="/assets/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/template/vendor/selectize/selectize.js"></script>
    <script>
        let btnSubmit = $('#btnSubmit'),
            form = $('#formAdd');

        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $("#sbu_id").selectize({
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
            $('form#deleteForm').attr('action', `/asset-parent/${id}`)
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
                    $('form#deleteForm').submit();
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
