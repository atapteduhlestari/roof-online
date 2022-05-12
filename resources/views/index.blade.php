@extends('layouts.master')
@push('styles')
    <link rel="stylesheet" href="/assets/app/vendor/fullcalendar/main.min.css">
@endpush
@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->

        {{-- {{ test('2022-06-01') }} --}}

        <!-- Content Row -->
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4"
                    src="{{ asset('/assets/template/img/undraw_moving_re_pipp.svg') }}">
                <!-- Illustrations -->
            </div>
            <div class="col-lg-6 mb-4">
                <!-- Illustrations -->
                <div class="card shadow mb-4 h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Group</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($groups as $item)
                                <div class="col-md-12 mb-3">
                                    <a href="/asset-group/{{ $item->id }}" class="btn btn-outline-dark btn-block">
                                        {{ $item->asset_group_name }}
                                    </a>
                                </div>
                            @endforeach
                            <div class="col-md-12 mb-3">
                                <a href="/asset-child" class="btn btn-outline-dark btn-block">
                                    Documents
                                </a>
                            </div>
                            <div class="col-md-12 mb-3">
                                <a href="/sdb" class="btn btn-outline-dark btn-block">
                                    SDB
                                </a>
                            </div>
                            <div class="col-md-12 mb-3">
                                <a href="/timeline" class="btn btn-outline-dark btn-block">
                                    Transaction Timeline
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($assets->count() > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Alert!</strong> assets need to be maintained.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
                @foreach ($assets as $asset)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $asset->asset_name }}</td>
                        <td>
                            {{ $asset->asset_no ?? '-' }}
                        </td>
                        <td>
                            {{ $asset->name }}
                        </td>
                        <td>
                            {{ createDate($asset->trn_date)->format('d M Y') }}
                        </td>
                        <td>
                            {!! remaining($asset->trn_date) !!}
                        </td>
                        <td>
                            <form action="/trn-maintenance/create">
                                <input type="hidden" name="id" value="{{ $asset->id }}" readonly>
                                <input type="hidden" name="check" value="document" readonly>
                                <button type="submit" class="btn btn-outline-dark btn-sm btn-block">
                                    <i class="fas fa-tools"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </table>
        @endif
        <hr>
        <div class="mt-5">
            <form action="/">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Filter Search</label>
                            <input type="month" class="form-control" name="date" value="{{ now()->format('Y-m') }}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </form>
        </div>
        <div id="calendar">
            {!! $calendar !!}
        </div>
        {{-- <div class="row">
            <div class="col-lg-6 mb-4">
                <!-- Earnings (Monthly) Card Example -->
                <div class="mb-4">
                    <div class="card border-left-success border-0 h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Assets</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Tidak Bergerak
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-lg-6 mb-4">
                <div class="mb-4">
                    <div class="card border-left-warning border-0 h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Assets</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Bergerak
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-folder fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="mb-4">
                    <div class="card border-left-danger border-0 h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Assets</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Lorem, ipsum.</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-search fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- /.container-fluid -->
@endsection

@push('scripts')
    {{-- <!-- Page level plugins -->
    <script src="/assets/template/vendor/chart.js/Chart.min.js"></script>
    
    <!-- Page level custom scripts -->
    <script src="/assets/template/js/demo/chart-area-demo.js"></script>
    <script src="/assets/template/js/demo/chart-pie-demo.js"></script> --}}

    <script src="/assets/app/vendor/fullcalendar/main.min.js"></script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listYear',
                },
                events: '/full-calendar',
            });

            calendar.render();
        });
    </script> --}}
@endpush
