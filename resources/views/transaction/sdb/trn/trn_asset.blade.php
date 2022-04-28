@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('title', 'GA | Transaction SDB')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Transaction SDB</h1>

        <div class="my-4">
            <form action="/trn-sdb/asset/store" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">SDB</label>
                            <input type="text" class="form-control not-allowed" value="{{ $sdb->sdb_name }}" readonly>

                            <input type="hidden" name="sdb_id" value="{{ $sdb->id }}">
                            @error('sdb_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Asset Name</label>
                            <input type="text" class="form-control not-allowed" value="{{ $asset->asset_name }}" readonly>

                            <input type="hidden" name="asset_id" value="{{ $asset->id }}">
                            @error('asset_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="take_out">Out Date</label>
                            <input type="date" class="form-control @error('take_out') is-invalid @enderror" name="take_out"
                                value="{{ old('take_out', $asset->trnSDBDetail->take_out ?? null) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="back_in">Return Date</label>
                            <input type="date" class="form-control" name="back_in"
                                value="{{ old('back_in', $asset->trnSDBDetail->back_in ?? null) }}">
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="/sdb/{{ $sdb->id }}" class="btn btn-secondary btn-sm mr-2">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary">
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
    <!-- Page level plugins -->
    <script src="/assets/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/app/js/table.js"></script>
    <script>
        let formDelete = $('#deleteForm');

        $(document).on('click', '#deleteButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            formDelete.attr('action', `/SDB/${id}`)
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
@endpush
