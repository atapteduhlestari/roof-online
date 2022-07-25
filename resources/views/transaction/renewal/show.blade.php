@extends('layouts.master')
@section('title', 'GA | Detail Renewal Transaction')
@section('container')
    <div class="container-fluid">
        <div class="col-12 mb-3 text-center">
            <img height="100px" class="" src="{{ asset('/assets/template/img/undraw_moving_re_pipp.svg') }}">
        </div>
        {{-- <div class="d-flex flex-md-row mb-3">
            <a title="Show as PDF" href="/trn-renewal/print" class="btn btn-light btn-w-100">
                <i class="fas fa-print"></i>
            </a>
        </div> --}}

        <div class="row">
            <div class="col-md-6 mb-3">
                <table class="table table-bordered mb-3">
                    <tr>
                        <th>No.</th>
                        <td>{{ $trnRenewal->trn_no }}</td>
                    </tr>
                    <tr>
                        <th>Cost Plan</th>
                        <td>{{ rupiah($trnRenewal->trn_value_plan) }}</td>
                    </tr>
                    <tr>
                        <th>Cost Realization</th>
                        <td>{{ rupiah($trnRenewal->trn_value) }}</td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td>{{ createDate($trnRenewal->trn_start_date)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Due Date</th>
                        <td>{{ createDate($trnRenewal->trn_date)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Document</th>
                        <td>{{ $trnRenewal->document->doc_name }}</td>
                    </tr>
                    <tr>
                        <th>Group</th>
                        <td>{{ $trnRenewal->document->parent->group->asset_group_name }}</td>
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
                        <th>SBU</th>
                        <td>{{ $trnRenewal->document->sbu->sbu_name }}</td>
                    </tr>
                    <tr>
                        <th>TYPE</th>
                        <td>{{ $trnRenewal->renewal->name }}</td>
                    </tr>
                    <tr>
                        <th>SDB</th>
                        <td>{{ $trnRenewal->document->sdb->sdb_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $trnRenewal->trn_desc }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <div class="row">
                                <div class="col-md">
                                    @if ($trnRenewal->trn_status)
                                        <button type="button" class="btn btn-sm btn-success btn-block">
                                            <i class="fas fa-check"></i> Done
                                        </button>
                                    @else
                                        @can('superadmin')
                                            <form action="/trn-maintenance/update-status/{{ $trnRenewal->id }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-danger btn-block">
                                                    <i class="fas fa-exclamation"></i> Waiting Approval
                                                </button>
                                            </form>
                                        @endcan
                                        @can('admin')
                                            <button type="button" class="btn btn-danger btn-block" disabled>
                                                <i class="fas fa-times"></i> Waiting Approval
                                            </button>
                                        @endcan
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>File</th>
                        <td>
                            @if ($trnRenewal->file)
                                <a title="download file" href="/trn-renewal/download/{{ $trnRenewal->id }}"
                                    class="text-dark">
                                    <i class="fas fa-download"></i>
                                </a>
                            @else
                                <a href="/trn-renewal/{{ $trnRenewal->id }}/edit">Add File</a>
                            @endif
                        </td>
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
