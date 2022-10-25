<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class MaintenanceExport implements
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

    public function map($trn): array
    {
        return [
            $trn->trn_no,
            $trn->maintenance->no_doc,
            $trn->asset->asset_name,
            $trn->asset->group->asset_group_name,
            $trn->asset->sbu->sbu_name,
            $trn->asset->sdb->sdb_name ?? '',
            $trn->maintenance->name,
            createDate($trn->trn_start_date)->format('d F Y'),
            createDate($trn->trn_date)->format('d F Y'),
            rupiah($trn->trn_value_plan ?? ''),
            rupiah($trn->trn_value),
            $trn->user->name,
            $trn->pemohon,
            $trn->penyetuju,
            $trn->trn_status ? 'Done' : '-',
            $trn->trn_desc,
        ];
    }

    public function headings(): array
    {
        return [
            'Code',
            'ISO',
            'Asset',
            'Group',
            'SBU',
            'SDB',
            'Type',
            'Start Date',
            'Due Date',
            'Cost Plan',
            'Cost Realization',
            'Creator',
            'Applicant',
            'Approval',
            'Status',
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
                $event->sheet->getStyle('A1:Q1')->applyFromArray([
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
