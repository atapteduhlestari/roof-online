@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/template/vendor/selectize/selectize.css" rel="stylesheet">
@endpush
@section('title', 'GA | Edit Appraisal')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Appraisal</h1>

        <div class="my-4">
            <form action="/appraisal/{{ $appraisal->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <input type="hidden" name="asset_id" value="{{ $appraisal->asset->id }}">
                    <div class="col-md-6 mb-3">
                        <label>Asset</label>
                        <input type="text" class="form-control not-allowed" value="{{ $appraisal->asset->asset_name }}"
                            readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apr_date">Date</label>
                        <input type="date" class="form-control @error('apr_date') is-invalid @enderror" name="apr_date"
                            id="apr_date" value="{{ old('apr_date', $appraisal->apr_date) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apr_value">Value</label>
                        <input type="text" class="form-control currency @error('apr_value') is-invalid @enderror"
                            name="apr_value" id="apr_value" value="{{ old('apr_value', $appraisal->apr_value) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="/appraisal" class="btn btn-sm btn-secondary">
                            Back
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@push('scripts')
    <script src="/assets/template/vendor/selectize/selectize.js"></script>
    <script src="/js/jquery.mask.min.js"></script>
    <script>
        $('.currency').mask('000.000.000.000', {
            reverse: true
        });

        $("#asset_id").selectize({
            create: false,
            sortField: "text",
        });
    </script>
@endpush
