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
            <th>Nilai buku</th>
            <th>Location</th>
            <th>Condition</th>
            <th>Person responsible</th>
            {{-- <th>Description</th> --}}
        </tr>

        {{-- TIPE AKTIVA BANGUNAN --}}
        <tr>
            <td></td>
            <th colspan="8">Tipe Aktiva : &nbsp; <b>BANGUNAN</b> </th>
        </tr>
        @foreach ($data['assets']->where('aktiva', 'Bangunan') as $bangunan)
            <tr>
                <td>{{ $bangunan->asset_code }}</td>
                <td>{{ $bangunan->asset_name }}</td>
                <td>{{ $bangunan->sbu->sbu_name ?? '' }}</td>
                <td>{{ createDate($bangunan->pcs_date)->format('d/m/Y') }}</td>
                <td style="text-align: right;">{{ rupiah($bangunan->pcs_value) }}</td>
                <td style="text-align: right;">{{ rupiah($bangunan->nilai_buku) }}</td>
                <td>{{ $bangunan->location ?? '' }}</td>
                <td>{{ $bangunan->condition == 1 ? 'Baik' : ($bangunan->condition == 2 ? 'Kurang' : 'Rusak') }}</td>
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

        {{-- TIPE AKTIVA MESIN --}}
        <tr>
            <td></td>
            <th colspan="8">Tipe Aktiva : &nbsp; <b>MESIN</b> </th>
        </tr>
        @foreach ($data['assets']->where('aktiva', 'Mesin') as $mesin)
            <tr>
                <td>{{ $mesin->asset_code }}</td>
                <td>{{ $mesin->asset_name }}</td>
                <td>{{ $mesin->sbu->sbu_name ?? '' }}</td>
                <td>{{ createDate($mesin->pcs_date)->format('d/m/Y') }}</td>
                <td style="text-align: right;">{{ rupiah($mesin->pcs_value) }}</td>
                <td style="text-align: right;">{{ rupiah($mesin->nilai_buku) }}</td>
                <td>{{ $mesin->location ?? '' }}</td>
                <td>{{ $mesin->condition == 1 ? 'Baik' : ($mesin->condition == 2 ? 'Kurang' : 'Rusak') }}</td>
                <td>{{ $mesin->employee->name ?? '' }}</td>
                {{-- <td>
                {{ $mesin->appraisals()->exists() ? createDate($mesin->appraisals->last()->apr_date)->format('d/m/Y') : null }}
            </td>
            <td>
                {{ rupiah($mesin->appraisals->last()->apr_value ?? '') }}

            </td> --}}
                {{-- <td>{{ $mesin->desc }}</td> --}}
            </tr>
        @endforeach

        {{-- TIPE AKTIVA MOBIL --}}
        <tr>
            <td></td>
            <th colspan="8">Tipe Aktiva : &nbsp; <b>MOBIL</b> </th>
        </tr>
        @foreach ($data['assets']->where('aktiva', 'Mobil') as $mobil)
            <tr>
                <td>{{ $mobil->asset_code }}</td>
                <td>{{ $mobil->asset_name }}</td>
                <td>{{ $mobil->sbu->sbu_name ?? '' }}</td>
                <td>{{ createDate($mobil->pcs_date)->format('d/m/Y') }}</td>
                <td style="text-align: right;">{{ rupiah($mobil->pcs_value) }}</td>
                <td style="text-align: right;">{{ rupiah($mobil->nilai_buku) }}</td>
                <td>{{ $mobil->location ?? '' }}</td>
                <td>{{ $mobil->condition == 1 ? 'Baik' : ($mobil->condition == 2 ? 'Kurang' : 'Rusak') }}</td>
                <td>{{ $mobil->employee->name ?? '' }}</td>
                {{-- <td>
                        {{ $mobil->appraisals()->exists() ? createDate($mobil->appraisals->last()->apr_date)->format('d/m/Y') : null }}
                    </td>
                    <td>
                        {{ rupiah($mobil->appraisals->last()->apr_value ?? '') }}

                    </td> --}}
                {{-- <td>{{ $mobil->desc }}</td> --}}
            </tr>
        @endforeach

        {{-- TIPE AKTIVA MOTOR --}}
        <tr>
            <td></td>
            <th colspan="8">Tipe Aktiva : &nbsp; <b>MOTOR</b> </th>
        </tr>
        @foreach ($data['assets']->where('aktiva', 'Motor') as $motor)
            <tr>
                <td>{{ $motor->asset_code }}</td>
                <td>{{ $motor->asset_name }}</td>
                <td>{{ $motor->sbu->sbu_name ?? '' }}</td>
                <td>{{ createDate($motor->pcs_date)->format('d/m/Y') }}</td>
                <td style="text-align: right;">{{ rupiah($motor->pcs_value) }}</td>
                <td style="text-align: right;">{{ rupiah($motor->nilai_buku) }}</td>
                <td>{{ $motor->location ?? '' }}</td>
                <td>{{ $motor->condition == 1 ? 'Baik' : ($motor->condition == 2 ? 'Kurang' : 'Rusak') }}</td>
                <td>{{ $motor->employee->name ?? '' }}</td>
                {{-- <td>
                        {{ $motor->appraisals()->exists() ? createDate($motor->appraisals->last()->apr_date)->format('d/m/Y') : null }}
                    </td>
                    <td>
                        {{ rupiah($motor->appraisals->last()->apr_value ?? '') }}

                    </td> --}}
                {{-- <td>{{ $motor->desc }}</td> --}}
            </tr>
        @endforeach

        {{-- TIPE AKTIVA PERALATAN --}}
        <tr>
            <td></td>
            <th colspan="8">Tipe Aktiva : &nbsp; <b>PERALATAN</b> </th>
        </tr>
        @foreach ($data['assets']->where('aktiva', 'Peralatan') as $peralatan)
            <tr>
                <td>{{ $peralatan->asset_code }}</td>
                <td>{{ $peralatan->asset_name }}</td>
                <td>{{ $peralatan->sbu->sbu_name ?? '' }}</td>
                <td>{{ createDate($peralatan->pcs_date)->format('d/m/Y') }}</td>
                <td style="text-align: right;">{{ rupiah($peralatan->pcs_value) }}</td>
                <td style="text-align: right;">{{ rupiah($peralatan->nilai_buku) }}</td>
                <td>{{ $peralatan->location ?? '' }}</td>
                <td>{{ $peralatan->condition == 1 ? 'Baik' : ($peralatan->condition == 2 ? 'Kurang' : 'Rusak') }}</td>
                <td>{{ $peralatan->employee->name ?? '' }}</td>
                {{-- <td>
                {{ $peralatan->appraisals()->exists() ? createDate($peralatan->appraisals->last()->apr_date)->format('d/m/Y') : null }}
            </td>
            <td>
                {{ rupiah($peralatan->appraisals->last()->apr_value ?? '') }}

            </td> --}}
                {{-- <td>{{ $peralatan->desc }}</td> --}}
            </tr>
        @endforeach

        {{-- TIPE AKTIVA TANAH --}}
        <tr>
            <td></td>
            <th colspan="8">Tipe Aktiva : &nbsp; <b>TANAH</b> </th>
        </tr>
        @foreach ($data['assets']->where('aktiva', 'Tanah') as $tanah)
            <tr>
                <td>{{ $tanah->asset_code }}</td>
                <td>{{ $tanah->asset_name }}</td>
                <td>{{ $tanah->sbu->sbu_name ?? '' }}</td>
                <td>{{ createDate($tanah->pcs_date)->format('d/m/Y') }}</td>
                <td style="text-align: right;">{{ rupiah($tanah->pcs_value) }}</td>
                <td style="text-align: right;">{{ rupiah($tanah->nilai_buku) }}</td>
                <td>{{ $tanah->location ?? '' }}</td>
                <td>{{ $tanah->condition == 1 ? 'Baik' : ($tanah->condition == 2 ? 'Kurang' : 'Rusak') }}</td>
                <td>{{ $tanah->employee->name ?? '' }}</td>
                {{-- <td>
                {{ $tanah->appraisals()->exists() ? createDate($tanah->appraisals->last()->apr_date)->format('d/m/Y') : null }}
            </td>
            <td>
                {{ rupiah($tanah->appraisals->last()->apr_value ?? '') }}

            </td> --}}
                {{-- <td>{{ $tanah->desc }}</td> --}}
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
