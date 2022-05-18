@extends('layouts.master')
@section('title', 'GA | Detail maintenance Transaction')
@section('container')
    <div class="container-fluid">
        <div class="col-12 mb-3 text-center">
            <img height="100px" class="" src="{{ asset('/assets/template/img/undraw_moving_re_pipp.svg') }}">
        </div>
        <div class="d-flex flex-md-row mb-3">
            <a title="Show as PDF" href="/trn-maintenance/print" class="btn btn-light btn-w-100">
                <i class="fas fa-print"></i>
            </a>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <table class="table table-bordered mb-3">
                    <tr>
                        <th>No.</th>
                        <td>{{ $trnMaintenance->trn_no }}</td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td>{{ createDate($trnMaintenance->trn_start_date)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Due Date</th>
                        <td>{{ createDate($trnMaintenance->trn_date)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Asset</th>
                        <td>{{ $trnMaintenance->asset->asset_name }}</td>
                    </tr>
                    <tr>
                        <th>Group</th>
                        <td>{{ $trnMaintenance->asset->group->asset_group_name }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $trnMaintenance->trn_desc }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 mb-3">
                <table class="table table-bordered">
                    <tr>
                        <th>ISO</th>
                        <td>{{ $trnMaintenance->maintenance->no_doc }}</td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{ $trnMaintenance->created_at->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>REN</th>
                        <td>{{ $trnMaintenance->maintenance->name }}</td>
                    </tr>
                    <tr>
                        <th>Cycle</th>
                        <td>{{ $trnMaintenance->maintenance->cycle->cycle_name }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 mb-3">
                <label>Pembuat</label>
                <input type="button" class="form-control text-left" value="{{ $trnMaintenance->user->name }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label>Menyetujui</label>
                <input type="button" class="form-control text-left" value="{{ $trnMaintenance->penyetuju }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label>Pemohon</label>
                <input type="button" class="form-control text-left" value="{{ $trnMaintenance->pemohon }}" readonly>
            </div>
        </div>
        <!-- End Row-->

    </div>
@endsection
