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
            <td colspan="2" style="font-size:12;">
                <strong>PT ATAP TEDUH LESTARI</strong>
            </td>
            <td>Tanggal Cetak: </td>
            <td>{{ now()->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:12;">
                <strong>Laporan Summary Asset</strong>
            </td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:12;">
                <strong>Periode :</strong>
            </td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="7">&nbsp; </td>
        </tr>
        <tr>
            <td colspan="7">Filter = </td>
        </tr>
        <tr>
            <td colspan="7">&nbsp;</td>
        </tr>
        <tr>
            <th rowspan="2" style="text-align: center;">SBU</th>
            <th colspan="2" style="text-align: center;">Baik</th>
            <th colspan="2" style="text-align: center;">Kurang</th>
            <th colspan="2" style="text-align: center;">Buruk</th>
        </tr>
        <tr>
            <th>Total Asset</th>
            <th>Total Cost</th>
            <th>Total Asset</th>
            <th>Total Cost</th>
            <th>Total Asset</th>
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
                    {{ $asset->where('condition', 2)->count() }}
                </td>
                <td style="text-align: right;">
                    {{ rupiah($asset->where('condition', 2)->sum('pcs_value')) }}
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
            <td colspan="7">&nbsp;</td>
        </tr>
        <tr>
            <th>
                Total
            </th>
            <th style="text-align: center">{{ $data['total_baik'] }}</th>
            <th style="text-align: right">{{ rupiah($data['total_cost_baik']) }}</th>
            <th style="text-align: center">{{ $data['total_kurang'] }}</th>
            <th style="text-align: right">{{ rupiah($data['total_cost_kurang']) }}</th>
            <th style="text-align: center">{{ $data['total_rusak'] }}</th>
            <th style="text-align: right">{{ rupiah($data['total_cost_rusak']) }}</th>
            {{-- <td colspan="2" style="text-align: right;">Total</td>
            <td>QTY: {{ $data['total_qty'] }}</td>
            <td>Cost: {{ rupiah($data['total_cost']) }}</td> --}}
        </tr>
    </table>
</body>

</html>
