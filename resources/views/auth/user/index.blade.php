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
        <div class="my-3 flex-grow-1">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addNewRecord">
                Add <i class="fas fa-plus-circle"></i>
            </button>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>SBU</th>
                                <th>Last IP</th>
                                <th>Last login</th>
                                <th>Last logout</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->sbu->sbu_name }}</td>
                                    <td>{{ $user->last_login_ip }}</td>
                                    <td>{{ diffForHuman($user->last_login_at) }}</td>
                                    <td>{{ diffForHuman($user->last_logout_at) }}</td>
                                    <td>{{ diffForHuman($user->created_at) }}</td>
                                    <td>{{ diffForHuman($user->updated_at) }}</td>
                                    <td>
                                        <span class="{{ $user->active ? 'text-success' : 'text-danger' }}">
                                            {{ $user->active ? 'active' : 'not active' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <a title="Edit Data" href="/user/{{ $user->username }}/edit"
                                                    class="btn btn-outline-dark text-xs">Edit</a>
                                            </div>
                                            <div>
                                                <form action="/user/{{ $user->id }}" method="post" id="deleteForm">
                                                    @csrf
                                                    @method('delete')
                                                    <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                        onclick="return false" id="deleteButton"
                                                        data-id="{{ $user->id }}">
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
                    <h5 class="modal-title text-white" id="addNewRecordLabel">Form - Add New Assets</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/user" method="POST" id="formAdd">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name') }}" autocomplete="off" autofocus>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sbu_id">SBU</label>
                                <select class="form-control @error('sbu_id') is-invalid @enderror" name="sbu_id"
                                    id="sbu_id">
                                    <option value=""></option>
                                    @foreach ($SBUs as $sbu)
                                        <option value="{{ $sbu->id }}"
                                            {{ old('sbu_id') == $sbu->id ? 'selected' : '' }}>
                                            {{ $sbu->sbu_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" value="{{ old('email') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" id="username" value="{{ old('username') }}" autocomplete="off">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password">
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
            $('form#deleteForm').attr('action', `/user/${id}`)
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
