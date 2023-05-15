<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel"
    xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv="content-type" content="text/plain; charset=UTF-8" />
    <title>Report Loan Detail</title>

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

        table#tableTTD,
        table#tableTTD td {
            border: none;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td colspan="2">{{ now()->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:12;">
                    <strong>PT ATAP TEDUH LESTARI</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:12;">
                    <strong>Laporan Detail Loan</strong>
                </td>

            </tr>
            <tr>
                <td colspan="2" style="font-size:12;">
                    <strong>Periode : {{ $loans['periode'] }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="12">&nbsp; </td>
            </tr>
            <tr>
                <td colspan="12">Filter = SBU : {{ $loans['sbu'] }}| Status :
                    {{ $loans['status'] }} | Total
                    Data : {{ $loans['total_data'] }}</td>
            </tr>
            <tr>
                <td colspan="12">&nbsp;</td>
            </tr>
            {{-- <tr>
                <td colspan="13">&nbsp;</td>
            </tr> --}}
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Type</th>
                <th>SBU</th>
                <th>Peminjam</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Return Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans['loans'] as $trn)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $trn->loan_type ? $trn->asset->asset_name : $trn->document->doc_name }}</td>
                    <td>{{ $trn->loan_type ? 'Asset' : 'Document' }}</td>
                    <td>{{ $trn->sbu->sbu_name ?? '' }}</td>
                    <td>{{ $trn->peminjam }}</td>
                    <td>{{ createDate($trn->loan_start_date)->format('d/m/Y') }}</td>
                    <td>{{ createDate($trn->loan_due_date)->format('d/m/Y') }}</td>
                    <td>{{ $trn->loan_date ? createDate($trn->loan_date)->format('d/m/Y') : '' }}</td>
                    <td>{{ $trn->loan_status ? 'Returned' : 'On loan' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <table id="tableTTD">
        <tr>
            <td style="text-align: center">
                Pembuat,
            </td>
            <td style="text-align: center">
                Mengetahui,
            </td>
            <td style="text-align: center">
                Menyetujui,
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="text-align:center;">
                (.............................)
            </td>
            <td style="text-align:center;">
                (.............................)
            </td>
            <td style="text-align:center;">
                (.............................)
            </td>
        </tr>
    </table>
</body>

</html>
