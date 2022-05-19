@extends('layouts.master')
@section('container')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 text-center">Reminder</h1>
        <div class="my-3">
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
            <div class="mt-3">
                <h1 class="h3 mb-2 text-gray-800 text-center">Timeline</h1>
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
    </div>
@endsection
