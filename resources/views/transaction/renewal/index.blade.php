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
            <div class="collapse show" id="collapseTransactionRenewal">
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-0 h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Assets</h5>
                                    <p class="text-xs">Rumah, Emas, etc..</p>
                                    <button type="button" class="btn px-5 btn-outline-primary btn-sm" data-toggle="modal"
                                        data-target="#modalAssetsParent">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Assets Docs</h5>
                                    <p class="text-xs">Documents</p>
                                    <button type="button" class="btn px-5 btn-outline-primary btn-sm" data-toggle="modal"
                                        data-target="#modalAssetsChild">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
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
                                <th>Document No.</th>
                                <th>Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trnRenewals as $trn)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trn->trn_no }}</td>
                                    <td>{{ createDate($trn->date)->format('d-m-Y, H:i') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <a href="/trn-renewal/{{ $trn->id }}/edit"
                                                    class="btn btn-info">Edit</a>
                                            </div>
                                            <div>
                                                <form action="/trn-renewal/{{ $trn->id }}" method="post"
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

    <!-- Modal Assets Parent -->
    <div class="modal fade" id="modalAssetsParent" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalAssetsParentLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAssetsParentLabel">Form Assets</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/trn-renewal" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="trn_no">Document No.</label>
                                <input type="text" class="form-control @error('trn_no') is-invalid @enderror" name="trn_no"
                                    value="{{ old('trn_no') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="trn_date">Date</label>
                                <input type="date" class="form-control @error('trn_date') is-invalid @enderror"
                                    name="trn_date" value="{{ old('trn_date') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="asset_id">Assets</label>
                                <select class="form-control @error('asset_id') is-invalid @enderror" id="asset_id"
                                    name="asset_id" required>
                                    <option value="">Select Assets</option>
                                    @foreach ($assets as $asset)
                                        <option value="{{ $asset->id }}"
                                            {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                            {{ $asset->asset_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="renewal_id">Select Renewal</label>
                                <select class="form-control @error('renewal_id') is-invalid @enderror" id="renewal_id"
                                    name="renewal_id" required>
                                    <option value="">Select Renewal</option>
                                    @foreach ($renewals as $renewal)
                                        <option value="{{ $renewal->id }}"
                                            {{ old('renewal_id') == $renewal->id ? 'selected' : '' }}>
                                            {{ $renewal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="trn_desc">Description</label>
                            <textarea class="form-control" id="trn_desc" name="trn_desc" cols="10" rows="5" required></textarea>
                        </div>
                        <input type="hidden" value="1" name="check">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Assets Chidl -->
    <div class="modal fade" id="modalAssetsChild" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalAssetsChildLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAssetsChildLabel">Form Assets Docs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/trn-renewal" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="trn_no">Document No.</label>
                                <input type="text" class="form-control @error('trn_no') is-invalid @enderror" name="trn_no"
                                    value="{{ old('trn_no') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="trn_date">Date</label>
                                <input type="date" class="form-control @error('trn_date') is-invalid @enderror"
                                    name="trn_date" value="{{ old('trn_date') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="asset_id">Assets</label>
                                <select class="form-control @error('asset_id') is-invalid @enderror" id="asset_id"
                                    name="asset_id" required>
                                    <option value="">Select Assets</option>
                                    @foreach ($assetChild as $child)
                                        <option value="{{ $child->id }}"
                                            {{ old('asset_id') == $child->id ? 'selected' : '' }}>
                                            {{ $child->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="renewal_id">Select Renewal</label>
                                <select class="form-control @error('renewal_id') is-invalid @enderror" id="renewal_id"
                                    name="renewal_id" required>
                                    <option value="">Select Renewal</option>
                                    @foreach ($renewals as $renewal)
                                        <option value="{{ $renewal->id }}"
                                            {{ old('renewal_id') == $renewal->id ? 'selected' : '' }}>
                                            {{ $renewal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="trn_desc">Description</label>
                            <textarea class="form-control" id="trn_desc" name="trn_desc" cols="10" rows="5"></textarea required>
                                    </div>
                                    <input type="hidden" value="0" name="check">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
                <script>
                    $(document).ready(function() {
                        $('#dataTable').DataTable();
                    });
                </script>
@endpush
