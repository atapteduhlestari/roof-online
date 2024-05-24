@extends('layouts.master')
@section('title', 'Group')
@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-3 text-gray-800">Groups</h1>
        <div class="my-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <a class="btn btn-lg btn-primary" style="width: 250px" href="/asset-group">Asset's Group</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <a class="btn btn-lg btn-info" style="width: 250px" href="/document-group">Document's Group</a>
                </div>
            </div>
        </div>
    </div>
@endsection
