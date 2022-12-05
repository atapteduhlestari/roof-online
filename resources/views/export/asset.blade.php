<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel"
    xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv="content-type" content="text/plain; charset=UTF-8" />
    <title>List Assets</title>

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
                <th colspan="3" rowspan="5">

                </th>
                <td colspan="3" style="text-align:center; font-size:14; vertical-align: middle;">
                    <strong>PT ATAP TEDUH LESTARI</strong>
                </td>
                <td>
                    No. Dokumen
                </td>
                <td>ATL-HOJ-SOP-GAN-03-01</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="2" style="text-align:center; font-size:14;">
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
                <td colspan="3" rowspan="2" style="text-align:center; font-size:14; vertical-align: middle;">
                    <strong>KARTU INVENTARISASI ASSET</strong>
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
            @foreach ($assets as $asset)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $asset->asset_name }}</td>
                    <td>{{ $asset->sbu->sbu_name ?? '' }}</td>
                    <td>{{ $asset->location ?? '' }}</td>
                    <td>{{ $asset->condition == 1 ? 'Baik' : ($asset->condition == 2 ? 'Kurang' : 'Rusak') }}</td>
                    <td>{{ $asset->employee->name ?? '' }}</td>
                    <td>{{ createDate($asset->pcs_date)->format('d/m/Y') }}</td>
                    <td>{{ rupiah($asset->pcs_value) }}</td>
                    {{-- <td>
                        {{ $asset->appraisals()->exists() ? createDate($asset->appraisals->last()->apr_date)->format('d/m/Y') : null }}
                    </td>
                    <td>
                        {{ rupiah($asset->appraisals->last()->apr_value ?? '') }}

                    </td> --}}
                    {{-- <td>{{ $asset->desc }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
