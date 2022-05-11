@extends('layouts.master')
@section('container')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Transaction Timeline</h1>
        <div class="my-3">
            <form action="/timeline">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Filter Search</label>
                            <input type="month" class="form-control" name="date">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </form>

            {!! $calendar !!}
        </div>
    </div>
@endsection
