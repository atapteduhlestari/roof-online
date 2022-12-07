<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel"
    xmlns="http://www.w3.org/TR/REC-html40">

<head>

    <meta http-equiv="content-type" content="text/plain; charset=UTF-8" />
    <title>Maintenance Transaction</title>

    <style>
        * {
            box-sizing: border-box;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 50%;
            height: 300px;
            /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        table,
        td,
        th {
            text-align: left;
            border: 1px solid;
        }

        table {

            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table class="table table-bordered">
        <tr>
            <td colspan="2" style="text-align:center; font-size:12; vertical-align: middle;">
                <strong>PT ATAP TEDUH LESTARI</strong>
            </td>
            <td>Tanggal Cetak: </td>
            <td>{{ now()->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center; font-size:12;">
                <strong>Laporan Summary Maintenance</strong>
            </td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center; font-size:12; vertical-align: middle;">
                <strong>Periode :
                </strong>
            </td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp; </td>
        </tr>
        <tr>
            <td colspan="4">Filter = SBU : </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <th>SBU</th>
            <th>Type</th>
            <th>QTY</th>
            <th>Cost</th>
        </tr>
        @foreach ($data['transactions'] as $key => $trn)
            @php
                $total_cost = $trn->sum('trn_value');
                $type = $trn->groupBy('renewal.name');
            @endphp
            <tr>
                <td>{{ $key }}</td>
                <td>
                    @foreach ($type as $k1 => $val1)
                        @php
                            $val1->put('cost', $val1->sum('trn_value'));
                        @endphp
                        <table>
                            <tr>
                                {{ $k1 }}
                            </tr>
                        </table>
                    @endforeach
                </td>
                <td>
                    @foreach ($type as $k2 => $val2)
                        @php
                            $val2->put('count', $val2->count() - 1);
                        @endphp

                        <table class="">
                            <tr>
                                {{ $val2['count'] }}</li>
                            </tr>
                        </table>
                    @endforeach
                </td>
                <td>
                    @foreach ($type as $k3 => $val3)
                        @php
                            $val3->put('cost', $val3->sum('trn_value'));
                        @endphp
                        <table>
                            <tr>
                                {{ rupiah($val3['cost']) }}</li>
                            </tr>
                        </table>
                    @endforeach
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" style="text-align: right;">Total</td>
            <td>QTY: {{ $data['total_qty'] }}</td>
            <td>Cost: {{ rupiah($data['total_cost']) }}</td>
        </tr>
    </table>
</body>

</html>
