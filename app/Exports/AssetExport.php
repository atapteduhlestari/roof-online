<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AssetExport implements FromCollection, WithHeadings, WithMapping
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function map($assets): array
    {
        return [
            $assets->id,
            $assets->asset_name,
            $assets->asset_code,
            $assets->asset_no,
            $assets->sbu->sbu_name,
            $assets->location,
            $assets->condition,
            $assets->employee->name ?? '',
            createDate($assets->pcs_date)->format('d F Y'),
            rupiah($assets->pcs_value),
            $assets->apr_date ? createDate($assets->apr_date)->format('d F Y') : null,
            rupiah($assets->apr_value),
            $assets->desc,

        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'Name',
            'Code',
            'No.',
            'SBU',
            'Location',
            'Condition',
            'Penanggung Jawab',
            'Purchase Date',
            'Purchase Value',
            'Aprraisal Date',
            'Aprraisal Value',
            'Description',
        ];
    }
}
