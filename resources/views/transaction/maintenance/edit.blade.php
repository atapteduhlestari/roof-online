@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Edit Maintenance Transaction')
@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Transaction | Edit Maintenance</h1>
        <div class="mb-5">
            <form action="/trn-maintenance/{{ $trnMaintenance->id }}" method="POST" id="formtrnMaintenance">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="trn_no">Document No.</label>
                        <input type="text" class="form-control @error('trn_no') is-invalid @enderror" name="trn_no"
                            placeholder="Document No." value="{{ old('trn_no', $trnMaintenance->trn_no) }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="trn_date">Date</label>
                        <input type="date" class="form-control @error('trn_date') is-invalid @enderror" name="trn_date"
                            value="{{ old('trn_date', $trnMaintenance->trn_date) }}">
                    </div>
                </div>
                <hr>
                <div class="row">
                    @if ($trnMaintenance->assets()->exists())
                        <div class="col-md-6 mb-3">
                            <label for="asset_id">Assets</label>
                            <input type="text" class="form-control" value="{{ $trnMaintenance->assets->asset_name }}"
                                disabled>
                            </select>
                        </div>
                    @endif

                    @if ($trnMaintenance->assetChildren()->exists())
                        <div class="col-md-6 mb-3" id="docsCol">
                            <label for="asset_child_id">Docs</label>
                            <input type="text" class="form-control" value="{{ $trnMaintenance->assetChildren->name }}"
                                disabled>

                        </div>
                    @endif
                    <div class="col-md-6 mb-3">
                        <label for="maintenance_id">Select Maintenance</label>
                        <input type="text" class="form-control" value="{{ $trnMaintenance->maintenance->name }}"
                            disabled>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="pelaksana">Pelaksana</label>
                        <select class="form-control @error('pelaksana') is-invalid @enderror" name="pelaksana">
                            <option value="">Pelaksana</option>
                            @foreach ($employees as $pelaksana)
                                <option value="{{ $pelaksana->name }}"
                                    {{ old('pelaksana', $trnMaintenance->pelaksana) == $pelaksana->name ? 'selected' : '' }}>
                                    {{ $pelaksana->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pemohon">Pemohon</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="penyetuju">Menyetujui</label>
                        <select class="form-control @error('penyetuju') is-invalid @enderror" name="penyetuju">
                            <option value="">Select Employees</option>
                            @foreach ($employees as $penyetuju)
                                <option value="{{ $penyetuju->name }}"
                                    {{ old('penyetuju', $trnMaintenance->penyetuju) == $penyetuju->name ? 'selected' : '' }}>
                                    {{ $penyetuju->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="trn_desc">Description</label>
                    <textarea class="form-control" id="trn_desc" name="trn_desc" cols="10"
                        rows="5">{{ old('trn_desc', $trnMaintenance->trn_desc) }}</textarea>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnSubmit" class="btn btn-primary">Submit</button>
            </form>
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
                                <th>Document No.</th>
                                <th>Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trnMaintenances as $trn)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trn->trn_no }}</td>
                                    <td>{{ createDate($trn->trn_date)->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <a href="/trn-maintenance/{{ $trn->id }}/edit"
                                                    class="btn btn-info">Edit</a>
                                            </div>
                                            <div>
                                                <form action="/trn-maintenance/{{ $trn->id }}" method="post"
                                                    id="deleteForm">
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
    <script src="/assets/template/vendor/selectize/selectize.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        let mySelect = $('#mySelect'),
            appendDocs = $('#docsCol'),
            checkDocs = $('#check'),
            form = $('#formtrnMaintenance'),
            btnSubmit = $('#btnSubmit');

        let $parentSelect = $("#asset_id").selectize({
            create: false,
            sortField: "text",
        });

        $("#maintenance_id").selectize({
            create: false,
            sortField: "text",
        });

        $(document).on('change', '#asset_id', async function() {
            let id = $(this).val();
            if (id) {
                await $.getJSON(`/api/asset-parent/get-data/${id}`, function(res) {
                    mySelect.prop('disabled', false);
                    mySelect.empty().append($('<option>').text('Select Docs').val(''));

                    $.each(res, function(index, item) {
                        mySelect.append($('<option>').text(item.name).val(item.id));
                    });
                });

                $(mySelect).change(function() {
                    if ($(this).val() === "")
                        checkDocs.val(1)
                    else
                        checkDocs.val(0)
                })

            } else {
                checkDocs.val(1)
                mySelect.prop('disabled', true);
                mySelect.empty().append($('<option>').text('Select Docs').val(''));
            }
        });

        btnSubmit.click(function() {
            $(this).prop('disabled', true);
            form.submit();
        });

        let formDelete = $('#deleteForm');

        $(document).on('click', '#deleteButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDelete.attr('action', `/trn-maintenance/${id}`)
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

    @if ($errors->any())
        <script>
            $('#modalAssetsParent').modal('show');
        </script>
    @endif
@endpush
