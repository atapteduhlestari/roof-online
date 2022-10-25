<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel"
    xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv="content-type" content="text/plain; charset=UTF-8" />
    <title>Maintenance Transaction</title>

    <style>
        table,
        td,
        th {
            border: 1px solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th colspan="4" rowspan="5">

                </th>
                <td colspan="7" style="text-align:center; font-size:14; vertical-align: middle;">
                    <strong>PT ATAP TEDUH LESTARI</strong>
                </td>
                <td>
                    No. Dokumen
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="7" rowspan="2" style="text-align:center; font-size:14;">
                    <strong>FORM</strong>
                </td>
                <td>Revisi</td>
                <td>00</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>{{ now()->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td colspan="7" rowspan="2" style="text-align:center; font-size:14; vertical-align: middle;">
                    <strong>Transaction Maintenance</strong>
                </td>
                <td>Department</td>
                <td>General Affair (GAN)</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="14">&nbsp;</td>
            </tr>
            {{-- <tr>
                <td colspan="13">&nbsp;</td>
            </tr> --}}
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>ISO</th>
                <th>Asset</th>
                <th>SBU</th>
                <th>Type</th>
                <th>Description</th>
                <th>SDB</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Cost Plan</th>
                <th>Cost Realization</th>
                <th>Creator</th>
                <th>Applicant</th>
                <th>Approval</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions['transactions'] as $trn)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $trn->trn_no }}</td>
                    <td>{{ $trn->maintenance->no_doc }}</td>
                    <td>{{ $trn->asset->asset_name }}</td>
                    <td>{{ $trn->sbu->sbu_name ?? '' }}</td>
                    <td>{{ $trn->maintenance->name }}</td>
                    <td>{{ $trn->trn_desc }}</td>
                    <td>{{ $trn->asset->sdb->sdb_name ?? '' }}</td>
                    <td>{{ createDate($trn->trn_start_date)->format('d F Y') }}</td>
                    <td>{{ createDate($trn->trn_date)->format('d F Y') }}</td>
                    <td>{{ rupiah($trn->trn_value_plan ?? '') }}</td>
                    <td>{{ rupiah($trn->trn_value) }}</td>
                    <td>{{ $trn->user->name }}</td>
                    <td>{{ $trn->pemohon }}</td>
                    <td>{{ $trn->penyetuju }}</td>
                    <td>{{ $trn->trn_status ? 'Closed' : 'Open' }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <b>Total</b>
                </td>
                <td>
                    <b>{{ rupiah($transactions['total_cost_plan']) }}</b>
                </td>
                <td>
                    <b>{{ rupiah($transactions['total_cost']) }}</b>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
