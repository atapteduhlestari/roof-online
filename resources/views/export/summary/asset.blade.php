<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel"
    xmlns="http://www.w3.org/TR/REC-html40">

<head>

    <meta http-equiv="content-type" content="text/plain; charset=UTF-8" />
    <title>Report Asset Summary</title>

    <style>
        table,
        td,
        th {
            text-align: left;
            border: 1px solid;
            vertical-align: top;
        }

        table {

            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table class="table table-bordered">
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
                <strong>Laporan Summary Asset</strong>
            </td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:12;">
                <strong>Periode : {{ $data['periode'] }}</strong>
            </td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="7">&nbsp; </td>
        </tr>
        <tr>
            <td colspan="7">Filter = Total Cost: {{ rupiah($data['total_cost']) }} | Asset qty:
                {{ $data['total_data'] }} </td>
        </tr>
        <tr>
            <td colspan="7">&nbsp;</td>
        </tr>
        <tr>
            <th rowspan="2">SBU</th>
            <th colspan="2">Baik</th>
            <th colspan="2">Rusak</th>
        </tr>
        <tr>
            <th>qty</th>
            <th>Total Cost</th>
            <th>qty</th>
            <th>Total Cost</th>
        </tr>
        @foreach ($data['assets'] as $key => $asset)
            <tr>
                <td>{{ $key }}</td>
                <td style="text-align: center">
                    {{ $asset->where('condition', 1)->count() }}
                </td>
                <td style="text-align: right;">
                    {{ rupiah($asset->where('condition', 1)->sum('pcs_value')) }}
                </td>
                <td style="text-align: center">
                    {{ $asset->where('condition', 3)->count() }}
                </td>
                <td style="text-align: right;">
                    {{ rupiah($asset->where('condition', 3)->sum('pcs_value')) }}
                </td>
            </tr>
        @endforeach

        <tr>
            <th>
                Total
            </th>
            <th style="text-align: center">{{ $data['total_baik'] }}</th>
            <th style="text-align: right">{{ rupiah($data['total_cost_baik']) }}</th>
            <th style="text-align: center">{{ $data['total_rusak'] }}</th>
            <th style="text-align: right">{{ rupiah($data['total_cost_rusak']) }}</th>
        </tr>
        {{-- <tr>
            <td>Asset qty: {{ $data['total_data'] }}</td>
            <td>Total Cost: {{ rupiah($data['total_cost']) }}</td>
        </tr> --}}
    </table>
</body>

</html>
