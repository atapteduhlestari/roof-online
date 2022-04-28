@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('title', 'GA | ' . $sdb->sdb_name)
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ $sdb->sdb_name }}</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Item</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Loan Date</th>
                                <th>Return Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sdb->assets as $asset)
                                <tr>
                                    <td>{{ $asset->asset_name }}</td>
                                    <td>
                                        @isset($asset->trnSDBDetail)
                                            {{ $asset->trnSDBDetail->status == '1' ? 'in Deposit Box' : 'on loan' }}
                                        @endisset

                                        @empty($asset->trnSDBDetail)
                                            No Transaction
                                        @endempty
                                    </td>
                                    <td>
                                        @isset($asset->trnSDBDetail)
                                            {{ createDate($asset->trnSDBDetail->take_out)->format('d F Y') }}
                                        @endisset
                                        @empty($doc->trnSDBDetail)
                                            -
                                        @endempty
                                    </td>
                                    <td>
                                        @isset($asset->trnSDBDetail->back_in)
                                            {{ createDate($asset->trnSDBDetail->back_in)->format('d F Y') }}
                                        @endisset
                                        @empty($doc->trnSDBDetail->back_in)
                                            -
                                        @endempty
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <form action="/trn-sdb/asset/{{ $asset->id }}">
                                                    <input type="hidden" name="sdb_id" value="{{ $sdb->id }}" readonly>
                                                    <input type="hidden" name="asset_id" value="{{ $asset->id }}"
                                                        readonly>
                                                    <button type="submit" class="btn btn-outline-dark btn-sm">
                                                        <i class="fas fa-plus"></i> Transaction
                                                    </button>
                                                </form>
                                            </div>
                                            <div>
                                                <form action="/trn-sdb/asset/{{ $asset->id }}" method="post"
                                                    id="deleteFormAsset">
                                                    @csrf
                                                    @method('delete')
                                                    <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                        onclick="return false" id="deleteAssetButton"
                                                        data-id="{{ $asset->id }}">
                                                        <i class="fas fa-minus"></i> Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($sdb->docs as $doc)
                                <tr>
                                    <td>{{ $doc->doc_name }}</td>
                                    <td>
                                        @isset($doc->trnSDBDetail)
                                            {{ $doc->trnSDBDetail->status == '1' ? 'in Deposit Box' : 'on loan' }}
                                        @endisset

                                        @empty($doc->trnSDBDetail)
                                            No Transaction
                                        @endempty
                                    </td>
                                    <td>
                                        @isset($doc->trnSDBDetail)
                                            {{ createDate($doc->trnSDBDetail->take_out)->format('d F Y') }}
                                        @endisset
                                        @empty($doc->trnSDBDetail)
                                            -
                                        @endempty
                                    </td>
                                    <td>
                                        @isset($doc->trnSDBDetail->back_in)
                                            {{ createDate($doc->trnSDBDetail->back_in)->format('d F Y') }}
                                        @endisset
                                        @empty($doc->trnSDBDetail->back_in)
                                            -
                                        @endempty
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <form action="/trn-sdb/doc/{{ $doc->id }}">
                                                    <input type="hidden" name="sdb_id" value="{{ $sdb->id }}"
                                                        readonly>
                                                    <input type="hidden" name="asset_child_id" value="{{ $doc->id }}"
                                                        readonly>
                                                    <button type="submit" class="btn btn-outline-dark btn-sm">
                                                        <i class="fas fa-plus"></i> Transaction
                                                    </button>
                                                </form>
                                            </div>
                                            <div>
                                                <form action="/trn-sdb/doc/{{ $doc->id }}" method="post"
                                                    id="deleteFormDoc">
                                                    @csrf
                                                    @method('delete')
                                                    <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                        onclick="return false" id="deleteDocButton"
                                                        data-id="{{ $doc->id }}">
                                                        <i class="fas fa-minus"></i> Remove
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
                <a href="/sdb" class="btn btn-secondary btn-sm mt-3">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 mt-5">
                <button class="btn btn-dark btn-sm btn-block border-0" type="button" data-toggle="collapse"
                    data-target="#collapaseTrn" aria-expanded="false" aria-controls="collapaseTrn" id="collapseButton">
                    <span>Renewal</span> <i id="toggler" class="fas fa-angle-right"></i>
                </button>
            </div>
        </div>
        <div class="collapse pb-3" id="collapaseTrn">
            <div class="">
                <div class="d-flex align-items-end mb-4">
                    <div class="flex-grow-1">
                        <form action="/trn-sdb/create">
                            <input type="hidden" name="id" value="{{ $sdb->id }}" readonly>
                            <button type="submit" class="btn btn-primary btn-sm">
                                Add <i class="fas fa-plus-circle"></i>
                            </button>
                        </form>
                    </div>

                    <img height="100" class="px-3 px-sm-4"
                        src="{{ asset('/assets/template/img/undraw_add_document_re_mbjx.svg') }}">

                    <!-- Button trigger modal -->
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No.</th>
                                <th>Payment Date</th>
                                <th>Payment Value</th>
                                <th>Due Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sdb->trnSDB as $trn)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trn->trn_no }}</td>
                                    <td>{{ rupiah($trn->ren_value) }}</td>
                                    <td>{{ createDate($trn->ren_date)->format('d F Y') }}</td>
                                    <td>{{ createDate($trn->due_date)->format('d F Y') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <a title="Edit Data" href="/trn-sdb/{{ $trn->id }}/edit"
                                                    class="btn btn-outline-dark text-xs">Edit</a>
                                            </div>
                                            <div>
                                                <form action="/trn-sdb/delete/{{ $trn->id }}" method="POST"
                                                    id="deleteTrnSDBForm">
                                                    @csrf
                                                    @method('delete')
                                                    <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                        onclick="return false" id="deleteTrnSDBButton"
                                                        data-id="{{ $trn->id }}">
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
        let formDeleteAsset = $('#deleteFormAsset'),
            formDeleteDoc = $('#deleteFormAsset'),
            formDeleteTrnSDB = $('#deleteTrnSDBForm'),
            toggler = $('#toggler');

        $(document).ready(function() {
            $('#dataTable').DataTable({
                "searching": false,
                "lengthChange": false,
                "pageLength": 50
            });
        });

        let collapseBtn = $('#collapseButton');

        $('#collapaseTrn').on('shown.bs.collapse', function() {
            toggler.addClass('fa-angle-down')
            toggler.removeClass('fa-angle-right')
        });

        $('#collapaseTrn').on('hidden.bs.collapse', function() {
            toggler.addClass('fa-angle-right')
            toggler.removeClass('fa-angle-down')
        });

        $(document).on('click', '#deleteAssetButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDeleteAsset.attr('action', `/trn-sdb/asset/${id}`)
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
                    formDeleteAsset.submit();
                }
            })
        });

        $(document).on('click', '#deleteDocButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDeleteDoc.attr('action', `/trn-sdb/doc/${id}`)
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
                    formDeleteDoc.submit();
                }
            })
        });

        $(document).on('click', '#deleteTrnSDBButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDeleteTrnSDB.attr('action', `/trn-sdb/${id}`)
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
                    formDeleteTrnSDB.submit();
                }
            })
        });
    </script>
@endpush
