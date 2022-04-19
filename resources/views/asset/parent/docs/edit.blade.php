@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('title', 'GA | Edit Docs')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="d-flex align-items-center mb-3">
            <div class="flex-grow-1">
                <h1 class="h3 mb-2 text-gray-800">Assets Edit | {{ $asset->asset_name }}</h1>
            </div>
            <a href="/asset-parent/docs/{{ $asset->id }}" class="btn btn-secondary btn-sm" data-dismiss="modal">
                <i class="fas fa-arrow-left"></i> {{ $asset->asset_name }}
            </a>
        </div>
        <!-- Page Heading -->
        <div class="my-4">
            <form id="formAdd" action="/asset-parent/docs/update/{{ $asset->id }}/{{ $child->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="doc_name">Document Name</label>
                            <input name="doc_name" id="doc_name" type="text"
                                class="form-control @error('doc_name') is-invalid @enderror"
                                value="{{ old('doc_name', $child->doc_name) }}" autocomplete="off" autofocus>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="doc_no">Document No</label>
                            <input name="doc_no" id="doc_no" type="text"
                                class="form-control @error('doc_no') is-invalid @enderror"
                                value="{{ old('doc_no', $child->doc_no) }}" autocomplete="off" autofocus>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input name="due_date" id="due_date" type="date"
                                class="form-control @error('due_date') is-invalid @enderror"
                                value="{{ old('due_date', $child->due_date) }}" autocomplete="off" autofocus>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea class="form-control  @error('desc') is-invalid @enderror" name="desc" id="desc" cols="30"
                                rows="5">{{ old('desc', $child->desc) }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="button" id="btnSubmit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@push('scripts')
    <!-- Page level plugins -->
    <script src="/assets/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/app/js/table.js"></script>
    <script>
        let btnSubmit = $('#btnSubmit'),
            form = $('#formAdd');

        btnSubmit.click(function() {
            $(this).prop('disabled', true);
            form.submit();
        });
    </script>
@endpush
