@extends('layouts.master')
@push('styles')
    <link href="/assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('title', 'GA | Edit SBU')
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit SBU {{ $sbu->sbu_name }}</h1>
        <div class="my-4">
            <form action="/sbu/{{ $sbu->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sbu_name">SBU Name</label>
                        <input type="text" class="form-control @error('sbu_name') is-invalid @enderror" name="sbu_name"
                            id="sbu_name" value="{{ old('sbu_name', $sbu->sbu_name) }}" autocomplete="off" autofocus>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sbu_address">SBU Address</label>
                        <input type="text" class="form-control @error('sbu_address') is-invalid @enderror" name="sbu_address"
                            id="sbu_address" value="{{ old('sbu_address', $sbu->sbu_address) }}" autocomplete="off">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <a href="/sbu" class="btn btn-secondary">
                            Back
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
