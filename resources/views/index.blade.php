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
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>
        <hr>
        <!-- Content Row -->
        <div class="row align-items-center mt-4">
            <div class="col-lg-6 mb-4">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4"
                    src="{{ asset('/assets/template/img/undraw_moving_re_pipp.svg') }}">
            </div>
            <div class="col-lg-6 mb-4">
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
                            @can('superadmin')
                                <div class="col-md-12 mb-3">
                                    <a href="/sdb" class="btn btn-outline-dark btn-block">
                                        SDB
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4 h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Transaction</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <a href="/trn-maintenance" class="btn btn-outline-dark btn-block">
                                    Maintenance
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <a href="/trn-renewal" class="btn btn-outline-dark btn-block">
                                    Renewal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img class="img-fluid px-3 px-sm-4 mt-3"
                    src="{{ asset('/assets/template/img/undraw_online_discussion_re_nn7e.svg') }}">
            </div>
        </div>
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
