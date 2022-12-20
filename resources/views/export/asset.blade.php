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
        <thead>
            <tr>
                <td colspan="2" style="font-size:12;">
                    <strong>PT ATAP TEDUH LESTARI</strong>
                </td>
                <td>Tanggal Cetak: {{ now()->format('d/m/Y') }}</td>
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
                <th>No</th>
                <th>Name</th>
                <th>SBU</th>
                <th>Location</th>
                <th>Condition</th>
                <th>Person Responsible</th>
                <th>Purchase Date</th>
                <th>Purchase Cost</th>
                {{-- <th>Description</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($data['assets'] as $asset)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $asset->asset_name }}</td>
                    <td>{{ $asset->sbu->sbu_name ?? '' }}</td>
                    <td>{{ $asset->location ?? '' }}</td>
                    <td>{{ $asset->condition == 1 ? 'Baik' : ($asset->condition == 2 ? 'Kurang' : 'Rusak') }}</td>
                    <td>{{ $asset->employee->name ?? '' }}</td>
                    <td>{{ createDate($asset->pcs_date)->format('d/m/Y') }}</td>
                    <td style="text-align: right;">{{ rupiah($asset->pcs_value) }}</td>
                    {{-- <td>
                        {{ $asset->appraisals()->exists() ? createDate($asset->appraisals->last()->apr_date)->format('d/m/Y') : null }}
                    </td>
                    <td>
                        {{ rupiah($asset->appraisals->last()->apr_value ?? '') }}

                    </td> --}}
                    {{-- <td>{{ $asset->desc }}</td> --}}
                </tr>
            @endforeach
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right;">
                <b>Total</b>
            </td>
            <td style="text-align: right;">
                <b>
                    {{ rupiah($data['assets']->sum('pcs_value')) }}
                </b>
            </td>
        </tbody>
    </table>
</body>

</html>
