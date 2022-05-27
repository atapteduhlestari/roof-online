@extends('layouts.master')
@section('container')
    <div class="container-fluid">
        <div class="pb-5">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="days">Cycle (Days)</label>
                            <input type="text" name="days" class="form-control" autocomplete="off">

                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-sm" type="submit">Submit</button>
            </form>
            <h1 class="h3 mb-2 text-gray-800 text-center">Reminder</h1>

            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Asset</th>
                    <th>No. Asset</th>
                    <th>Maintenance Name</th>
                    <th>Due Date</th>
                    <th>Remaining Days</th>
                    <th>Action</th>
                </tr>
                @foreach ($data as $asset)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $asset['asset_name'] }}</td>
                        <td>
                            {{ $asset->asset_no ?? '-' }}
                        </td>
                        <td>
                            {{ $asset['name'] }}
                        </td>
                        <td>
                            {{ createDate($asset['date'])->format('d M Y') }}
                        </td>
                        <td>

                            {!! remaining($asset['date']) !!}

                            <br>
                            {{-- {{ $asset->trnMaintenance->maintenance->cycle->qty }} --}}
                        </td>
                        <td>
                            <form action="/trn-maintenance/create">
                                <input type="hidden" name="id" value="{{ $asset['id'] }}" readonly>
                                <input type="hidden" name="check" value="document" readonly>
                                <button type="submit" class="btn btn-outline-dark btn-sm btn-block">
                                    <i class="fas fa-tools"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>


        <div class="pt-5">
            <h1 class="h3 mb-2 text-gray-800 text-center">Timeline</h1>
            <form action="/timeline">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="month" class="form-control" name="date">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-sm">Search</button>
            </form>
            {!! $calendar !!}
        </div>
    </div>
@endsection
