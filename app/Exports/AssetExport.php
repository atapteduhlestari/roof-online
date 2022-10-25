<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class AssetExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithEvents,
    WithProperties,
    ShouldAutoSize
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

    public function map($asset): array
    {
        return [
            $asset->asset_name,
            $asset->asset_code,
            $asset->asset_no,
            $asset->sbu->sbu_name,
            $asset->location,
            $asset->condition == 1 ? 'Baik' : ($asset->condition == 2 ? 'Kurang' : 'Buruk'),
            $asset->employee->name ?? '',
            createDate($asset->pcs_date)->format('d/m/Y'),
            rupiah($asset->pcs_value),
            $asset->appraisals()->exists() ? createDate($asset->appraisals->last()->apr_date)->format('d/m/Y') : null,
            rupiah($asset->appraisals->last()->apr_value ?? ''),
            $asset->desc,
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Code',
            'No. Asset',
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

    public function properties(): array
    {
        return [
            'creator'        => 'Edward Evbert',
            'title'          => 'Asset Export',
            'description'    => 'Latest Asset',
            'subject'        => 'Asset Report',
            'company'        => 'Atap Teduh Lestari',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:M1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
            }
        ];
    }
}
