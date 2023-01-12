<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel"
    xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv="content-type" content="text/plain; charset=UTF-8" />
    <title>Report Asset Detail</title>

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
                <strong>Laporan Detail Asset</strong>
            </td>

        </tr>
        <tr>
            <td colspan="2" style="font-size:12;">
                <strong>Periode : {{ $data['periode'] }}</strong>
            </td>
        </tr>
        <tr>
            <td colspan="8">&nbsp; </td>
        </tr>
        <tr>
            <td colspan="8">Filter = SBU : {{ $data['sbu'] }}| Condition :
                {{ $data['condition'] }}| Total Cost
                :{{ rupiah($data['total_cost']) }} | Total
                Data : {{ $data['total_data'] }}</td>
        </tr>
        <tr>
            <td colspan="8">&nbsp;</td>
        </tr>
        {{-- <tr>
                <td colspan="13">&nbsp;</td>
            </tr> --}}
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>SBU</th>
            <th>Date</th>
            <th>Cost</th>
            <th>Nilai Buku</th>
            <th>Location</th>
            <th>Condition</th>
            <th>Person Responsible</th>
            {{-- <th>Description</th> --}}
        </tr>
        @foreach ($data['assets'] as $bangunan)
            <tr>
                <td>{{ $bangunan->asset_code }}</td>
                <td>{{ $bangunan->asset_name }}</td>
                <td>{{ $bangunan->sbu->sbu_name ?? '' }}</td>
                <td>{{ createDate($bangunan->pcs_date)->format('d/m/Y') }}</td>
                <td style="text-align: right;">{{ rupiah($bangunan->pcs_value) }}</td>
                <td style="text-align: right;">{{ rupiah($bangunan->nilai_buku) }}</td>
                <td>{{ $bangunan->location ?? '' }}</td>
                <td>{{ $bangunan->condition == 1 ? 'Baik' : 'Rusak' }}</td>
                <td>{{ $bangunan->employee->name ?? '' }}</td>
                {{-- <td>
                {{ $bangunan->appraisals()->exists() ? createDate($bangunan->appraisals->last()->apr_date)->format('d/m/Y') : null }}
            </td>
            <td>
                {{ rupiah($bangunan->appraisals->last()->apr_value ?? '') }}

            </td> --}}
                {{-- <td>{{ $bangunan->desc }}</td> --}}
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right;">
                <b>Total Cost</b>
            </td>
            <td style="text-align: right;">
                <b>
                    {{ rupiah($data['assets']->sum('pcs_value')) }}
                </b>
            </td>
        </tr>
    </table>
</body>

</html>
