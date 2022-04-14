@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Edit Renewal Transaction')
@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Transaction | Edit Renewal</h1>
        <div class="mb-5">
            <form action="/trn-renewal/{{ $trnRenewal->id }}" method="POST" id="formTrnRenewal">
                @csrf
                @method('PUT')
                <input type="hidden" name="trn_id" value="{{ $trnRenewal->id }}" readonly>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="trn_no">No. Document</label>
                        <input type="text" class="form-control not-allowed" value="{{ $trnRenewal->trn_no }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="trn_no">No ISO</label>
                        <input type="text" class="form-control not-allowed" value="{{ $trnRenewal->renewal->no_doc }}"
                            disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="trn_date">Date</label>
                        <input type="date" class="form-control @error('trn_date') is-invalid @enderror" name="trn_date"
                            value="{{ old('trn_date', $trnRenewal->trn_date) }}">
                    </div>
                </div>
                <hr>
                <div class="row">
                    @if ($trnRenewal->assets()->exists())
                        <div class="col-md-6 mb-3">
                            <label for="asset_id">Assets</label>
                            <input type="text" class="form-control not-allowed"
                                value="{{ $trnRenewal->assets->asset_name }}" disabled>
                            </select>
                        </div>
                    @endif

                    @if ($trnRenewal->assetChildren()->exists())
                        <div class="col-md-6 mb-3" id="docsCol">
                            <label for="asset_child_id">Docs</label>
                            <input type="text" class="form-control not-allowed"
                                value="{{ $trnRenewal->assetChildren->name }}" disabled>

                        </div>
                    @endif
                    <div class="col-md-6 mb-3">
                        <label for="renewal_id">Select Renewal</label>
                        <input type="text" class="form-control not-allowed" value="{{ $trnRenewal->renewal->name }}"
                            disabled>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="pemohon">Pemohon</label>
                        <select class="form-control @error('pemohon') is-invalid @enderror" name="pemohon" id="pemohon">
                            <option value="">Pemohon</option>
                            @foreach ($employees as $pemohon)
                                <option value="{{ $pemohon->name }}"
                                    {{ old('pemohon', $trnRenewal->pemohon) == $pemohon->name ? 'selected' : '' }}>
                                    {{ $pemohon->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pembuat">Pembuat</label>
                        <input type="text" class="form-control not-allowed" value="{{ auth()->user()->name }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="penyetuju">Menyetujui</label>
                        <select class="form-control @error('penyetuju') is-invalid @enderror" name="penyetuju"
                            id="penyetuju">
                            <option value="">Select Employees</option>
                            @foreach ($employees as $penyetuju)
                                <option value="{{ $penyetuju->name }}"
                                    {{ old('penyetuju', $trnRenewal->penyetuju) == $penyetuju->name ? 'selected' : '' }}>
                                    {{ $penyetuju->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="trn_desc">Description</label>
                    <textarea class="form-control" id="trn_desc" name="trn_desc" cols="10"
                        rows="5">{{ old('trn_desc', $trnRenewal->trn_desc) }}</textarea>
                </div>
                <a href="/trn-renewal" class="btn btn-secondary">Back</a>
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
                                    <th>Type</th>
                                    <th>Due Date</th>
                                    <th>Created</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trnRenewals as $trn)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $trn->trn_no }}</td>
                                        <td>{{ $trn->renewal->name }}</td>
                                        <td>{{ createDate($trn->trn_date)->format('d-m-Y') }}</td>
                                        <td>{{ $trn->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <div>
                                                    <a title="Detail Data" href="/trn-renewal/{{ $trn->id }}"
                                                        class="btn btn-outline-dark text-xs">
                                                        <i class="fas fa-search-plus"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a title="Edit Data" href="/trn-renewal/{{ $trn->id }}/edit"
                                                        class="btn btn-outline-dark text-xs">Edit</a>
                                                </div>
                                                <div>
                                                    <form action="/trn-renewal/{{ $trn->id }}" method="post"
                                                        id="deleteForm">
                                                        @csrf
                                                        @method('delete')
                                                        <button title="Delete Data" class="btn btn-outline-danger text-xs"
                                                            onclick="return false" id="deleteButton"
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
    </div>
@endsection
@push('scripts')
    <!-- Page level plugins -->
    <script src="/assets/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/template/vendor/selectize/selectize.js"></script>
    <script src="/assets/app/js/table.js"></script>
    <script>
        let form = $('#formTrnRenewal'),
            btnSubmit = $('#btnSubmit');

        $("#pemohon").selectize({
            create: false,
            sortField: "text",
        });

        $("#penyetuju").selectize({
            create: false,
            sortField: "text",
        });

        btnSubmit.click(function() {
            $(this).prop('disabled', true);
            form.submit();
        });

        let formDelete = $('#deleteForm');

        $(document).on('click', '#deleteButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDelete.attr('action', `/trn-renewal/${id}`)
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
