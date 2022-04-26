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
            <form action="/trn-maintenance/{{ $trnMaintenance->id }}" method="POST" id="formTrnmaintenance">
                @csrf
                @method('PUT')
                <div class="row">
                    <input type="hidden" name="asset_id" value="{{ $trnMaintenance->asset_id }}">
                    <div class="col-md-6 mb-3">
                        <label>Asset</label>
                        <input type="text" class="form-control not-allowed"
                            value="{{ $trnMaintenance->asset->asset_name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="maintenance_id">Select maintenance</label>
                        <select class="form-control @error('maintenance_id') is-invalid @enderror" id="maintenance_id"
                            name="maintenance_id">
                            <option value=""></option>
                            @foreach ($maintenances as $maintenance)
                                <option value="{{ $maintenance->id }}"
                                    {{ old('maintenance_id', $trnMaintenance->maintenance_id) == $maintenance->id ? 'selected' : '' }}>
                                    {{ $maintenance->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="trn_date">Due Date</label>
                        <input type="date" class="form-control @error('trn_date') is-invalid @enderror" name="trn_date"
                            value="{{ old('trn_date', $trnMaintenance->trn_date) }}">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="pemohon">Pemohon</label>
                        <select class="form-control @error('pemohon') is-invalid @enderror" name="pemohon" id="pemohon">
                            <option value=""></option>
                            @foreach ($employees as $pemohon)
                                <option value="{{ $pemohon->name }}"
                                    {{ old('pemohon', $trnMaintenance->pemohon) == $pemohon->name ? 'selected' : '' }}>
                                    {{ $pemohon->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pembuat">Pembuat</label>
                        <input type="text" class="form-control not-allowed" value="{{ $trnMaintenance->user->name }}"
                            disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="penyetuju">Menyetujui</label>
                        <select class="form-control @error('penyetuju') is-invalid @enderror" name="penyetuju"
                            id="penyetuju">
                            <option value=""></option>
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
                    <textarea class="form-control  @error('trn_desc') is-invalid @enderror" id="trn_desc" name="trn_desc" cols="10"
                        rows="5">{{ old('trn_desc', $trnMaintenance->trn_desc) }}</textarea>
                </div>
                <a href="/trn-maintenance" class="btn btn-secondary btn-sm mr-2">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <button type="button" id="btnSubmit" class="btn btn-primary">Submit</button>
            </form>
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
        let form = $('#formTrnmaintenance'),
            btnSubmit = $('#btnSubmit');

        $("#maintenance_id").selectize({
            create: false,
            sortField: "text",
        });

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
    </script>
@endpush
