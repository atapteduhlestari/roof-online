@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Renewal Transaction')
@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex align-items-center mb-3">
            <div class="flex-grow-1">
                <h1 class="h3 mb-2 text-gray-800">Renewal | {{ $assetChild->doc_name }}</h1>
            </div>
            <a href="/asset-parent/docs/{{ $assetChild->id }}" class="btn btn-secondary btn-sm mr-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="/trn-renewal" class="btn btn-dark btn-sm">
                <i class="fas fa-external-link-square-alt"></i> Table Renewal
            </a>
        </div>
        <div class="mb-5">
            <form action="/trn-renewal" method="POST" id="formTrnRenewal">
                @csrf
                <div class="row">
                    <input type="hidden" name="asset_child_id" value="{{ $assetChild->id }}">
                    <div class="col-md-6 mb-3">
                        <label>Document</label>
                        <input type="text" class="form-control not-allowed" value="{{ $assetChild->doc_name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="renewal_id">Select Renewal</label>
                        <select class="form-control @error('renewal_id') is-invalid @enderror" id="renewal_id"
                            name="renewal_id">
                            <option value=""></option>
                            @foreach ($renewals as $renewal)
                                <option value="{{ $renewal->id }}"
                                    {{ old('renewal_id') == $renewal->id ? 'selected' : '' }}>
                                    {{ $renewal->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="trn_date">Due Date</label>
                        <input type="date" class="form-control @error('trn_date') is-invalid @enderror" name="trn_date"
                            value="{{ old('trn_date') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="trn_value">Cost</label>
                        <input type="text" class="form-control currency @error('trn_value') is-invalid @enderror"
                            name="trn_value" value="{{ old('trn_value') }}" autocomplete="off">
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
                                    {{ old('pemohon') == $pemohon->name ? 'selected' : '' }}>
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
                            <option value=""></option>
                            @foreach ($employees as $penyetuju)
                                <option value="{{ $penyetuju->name }}"
                                    {{ old('penyetuju') == $penyetuju->name ? 'selected' : '' }}>
                                    {{ $penyetuju->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="trn_desc">Description</label>
                    <textarea class="form-control @error('trn_desc') is-invalid @enderror" id="trn_desc" name="trn_desc" cols="10"
                        rows="5">{{ old('trn_desc') }}</textarea>
                </div>
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
    <script src="/js/jquery.mask.min.js"></script>

    <script>
        let form = $('#formTrnRenewal'),
            btnSubmit = $('#btnSubmit');

        $('.currency').mask('000.000.000.000', {
            reverse: true
        });

        $("#renewal_id").selectize({
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
