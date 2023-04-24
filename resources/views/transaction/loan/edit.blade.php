@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Loan Transaction')
@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-0 text-gray-800">Transaction | Loan</h1>

        <div class="card shadow mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Loan</h6>
            </div>
            <div class="card-body">
                <form action="/loan/{{ $loan->id }}" method="POST" id="formLoan">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input id="loan_type" name="loan_type" type="hidden" value="{{ $loan->loan_type }}">

                        @if ($loan->loan_type)
                            <div class="col-md-12 mb-3" id="assetSelectForm">
                                <label for="asset_id">Asset</label>
                                <input type="text" class="form-control @error('asset_id') is-invalid @enderror"
                                    value="{{ $loan->asset->asset_name }}" readonly>
                            </div>
                        @else
                            <div class="col-md-12 mb-3" id="assetSelectForm">
                                <label for="asset_id">Document</label>
                                <input type="text" class="form-control @error('asset_id') is-invalid @enderror"
                                    value="{{ $loan->document->doc_name . ' - ' . $loan->document->parent->asset_name ?? '' }}"
                                    readonly>
                            </div>
                        @endif

                        <div class="col-md-6 mb-3">
                            <label for="loan_start_date">Start Date</label>
                            <input type="date" class="form-control @error('loan_start_date') is-invalid @enderror"
                                name="loan_start_date" value="{{ old('loan_start_date', $loan->loan_start_date) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="loan_due_date">Due Date</label>
                            <input type="date" class="form-control @error('loan_due_date') is-invalid @enderror"
                                name="loan_due_date" value="{{ old('loan_due_date', $loan->loan_due_date) }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="peminjam">Peminjam</label>
                            <select class="form-control @error('peminjam') is-invalid @enderror" name="peminjam"
                                id="peminjam">
                                <option value="">Select Employees</option>
                                @foreach ($employees as $peminjam)
                                    <option value="{{ $peminjam->name }}"
                                        {{ old('peminjam', $loan->peminjam) == $peminjam->name ? 'selected' : '' }}>
                                        {{ $peminjam->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pembuat">Pembuat</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sbu_id">SBU</label>
                            <select class="form-control @error('sbu_id') is-invalid @enderror" name="sbu_id"
                                id="sbu_id">
                                <option value="">Select SBU</option>
                                @foreach ($SBUs as $sbu)
                                    <option value="{{ $sbu->id }}"
                                        {{ old('sbu_id', $loan->sbu_id) == $sbu->id ? 'selected' : '' }}>
                                        {{ $sbu->sbu_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" cols="10" rows="5">{{ old('description', $loan->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="btnSubmit" class="btn btn-primary">Submit</button>
                </form>
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

        let form = $('#formLoan'),
            btnSubmit = $('#btnSubmit');

        $("#asset_child_id").selectize({
            create: false,
            sortField: "text",
        });

        $("#asset_id").selectize({
            create: false,
            sortField: "text",
        });

        $("#sbu_id").selectize({
            create: false,
            sortField: "text",
        });

        $("#peminjam").selectize({
            create: false,
            sortField: "text",
        });

        btnSubmit.click(function() {
            $(this).prop('disabled', true);
            form.submit();
        });
    </script>
@endpush
