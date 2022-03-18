@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('title', 'GA | Renewal Transaction')
@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Transaction | Renewal</h1>
        <div class="my-3">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseTransactionRenewal"
                aria-expanded="false" aria-controls="collapseTransactionRenewal">
                Add New Transaction
            </button>
            <div class="collapse" id="collapseTransactionRenewal">
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-0 h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Assets</h5>
                                    <p class="text-xs">Rumah, Emas, etc..</p>
                                    <a href="/trn-renewal/asset-parent" class="btn px-5 btn-outline-primary btn-sm">
                                        <i class="fas fa-plus-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Assets Child</h5>
                                    <p class="text-xs">Documents</p>
                                    <a href="/trn-renewal/asset-child" class="btn px-5 btn-outline-primary btn-sm">
                                        <i class="fas fa-plus-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Transaction</h6>
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
                            @foreach ($trnRenewals as $trn)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trn->trn_no }}</td>
                                    <td>{{ $trn->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <a href="/renewal/{{ $trn->id }}/edit" class="btn btn-info">Edit</a>
                                            </div>
                                            <div>
                                                <form action="/renewal/{{ $trn->id }}" method="post" id="deleteForm">
                                                    @csrf
                                                    @method('delete')
                                                    <button title="Hapus Data" class="btn btn-danger" onclick="return false"
                                                        id="deleteButton" data-id="{{ $trn->id }}">
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
@endsection
@push('scripts')
    <!-- Page level plugins -->
    <script src="/assets/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
