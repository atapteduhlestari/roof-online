@extends('layouts.master')
@section('title', 'Group')
@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-3 text-gray-800">Master Type</h1>
        <div class="my-4">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <a class="btn btn-lg btn-primary" style="width: 250px" href="/asset-group">Asset Type</a>
                </div>

                <div class="col-md-3 mb-3">
                    <a class="btn btn-lg btn-info" style="width: 250px" href="/document-group">Document Type</a>
                </div>

                <div class="col-md-3 mb-3">
                    <a class="btn btn-lg btn-warning" style="width: 250px" href="/maintenance">Maintenance Type</a>
                </div>

                <div class="col-md-3 mb-3">
                    <a class="btn btn-lg btn-success" style="width: 250px" href="/renewal">Renewal Type</a>
                </div>
            </div>
        </div>
    </div>
@endsection
