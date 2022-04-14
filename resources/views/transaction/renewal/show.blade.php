@extends('layouts.master')
@section('title', 'GA | Detail Renewal Transaction')
@section('container')
    <div class="container-fluid">
        <div class="col-12 mb-3 text-center">
            <img height="100px" class="" src="{{ asset('/assets/template/img/undraw_moving_re_pipp.svg') }}">
        </div>
        <div class="d-flex flex-md-row mb-3">
            <a title="Show as PDF" href="/trn-renewal/print" class="btn btn-light btn-w-100">
                <i class="fas fa-print"></i>
            </a>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <table class="table table-bordered mb-3">
                    <tr>
                        <th>No.</th>
                        <td>{{ $trnRenewal->trn_no }}</td>
                    </tr>
                    <tr>
                        <th>Due Date</th>
                        <td>{{ createDate($trnRenewal->trn_date)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>{{ $trnRenewal->assets ? 'Asset' : 'Docs' }}
                        </th>
                        <td>{{ $trnRenewal->assets ? $trnRenewal->assets->asset_name : $trnRenewal->assetChildren->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>Group</th>
                        <td> {{ $trnRenewal->assets? $trnRenewal->assets->group->asset_group_name: $trnRenewal->assetChildren->parent->group->asset_group_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $trnRenewal->trn_desc }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 mb-3">
                <table class="table table-bordered">
                    <tr>
                        <th>ISO</th>
                        <td>{{ $trnRenewal->renewal->no_doc }}</td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{ $trnRenewal->created_at->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>REN</th>
                        <td>{{ $trnRenewal->renewal->name }}</td>
                    </tr>
                    <tr>
                        <th>Cycle</th>
                        <td>{{ $trnRenewal->renewal->cycle->cycle_name }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 mb-3">
                <label>Pembuat</label>
                <input type="button" class="form-control text-left" value="{{ $trnRenewal->user->name }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label>Menyetujui</label>
                <input type="button" class="form-control text-left" value="{{ $trnRenewal->penyetuju }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label>Pemohon</label>
                <input type="button" class="form-control text-left" value="{{ $trnRenewal->pemohon }}" readonly>
            </div>
        </div>
        <!-- End Row-->

    </div>
@endsection
