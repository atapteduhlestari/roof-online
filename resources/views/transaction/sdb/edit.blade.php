@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | SDB Transaction')
@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex align-items-center mb-3">
            <div class="flex-grow-1">
                <h1 class="h3 mb-2 text-gray-800">Renewal | {{ $trnSDB->sdb->sdb_name }}</h1>
            </div>
            <a href="/sdb" class="btn btn-secondary btn-sm mr-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="/sdb" class="btn btn-dark btn-sm">
                <i class="fas fa-external-link-square-alt"></i> Table SDB
            </a>
        </div>
        <div class="mb-5">
            <form action="/trn-sdb/{{ $trnSDB->id }}" method="POST" id="formTrnSDB">
                @csrf
                @method('PUT')
                <div class="row">
                    <input type="hidden" name="sdb_id" value="{{ $trnSDB->sdb->id }}">
                    <div class="col-md-6 mb-3">
                        <label>Document</label>
                        <input type="text" class="form-control not-allowed" value="{{ $trnSDB->sdb->sdb_name }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="ren_date">Renewal Date</label>
                        <input type="date" class="form-control @error('ren_date') is-invalid @enderror" name="ren_date"
                            value="{{ old('ren_date', $trnSDB->ren_date) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="ren_value">Renewal Value</label>
                        <input type="text" class="form-control currency @error('ren_value') is-invalid @enderror"
                            name="ren_value" value="{{ old('ren_value', $trnSDB->ren_value) }}" autocomplete="off">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="due_date">Due Date</label>
                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date"
                            value="{{ old('due_date', $trnSDB->due_date) }}">
                    </div>
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
    <script src="/js/jquery.mask.min.js"></script>
    <script>
        let form = $('#formTrnSDB'),
            btnSubmit = $('#btnSubmit');

        $('.currency').mask('000.000.000.000', {
            reverse: true
        });

        btnSubmit.click(function() {
            $(this).prop('disabled', true);
            form.submit();
        });
    </script>
@endpush
