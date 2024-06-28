<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class MaintenanceExportDetailView implements
    FromView,
    WithProperties,
    WithEvents
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $transactions = $this->data;
        return view('export.maintenance', compact('transactions'));
    }

    public function properties(): array
    {
        return [
            'creator'        => 'Staff IT',
            'lastModifiedBy' => 'Administrator',
            'title'          => 'Maintenance Detail Report',
            'description'    => 'Maintenance Detail Report',
            'subject'        => 'Maintenance Detail Report',
            'category'       => 'Report',
            'company'        => 'PT. ATAP TEDUH LESTARI',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $styleArray = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_LEFT,
                    ],
                ];
                $cellRange = 'A1:B3';
                $sheet = $event->sheet;

                $sheet->getStyle('A8:L8')->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('A9D08E');
                $sheet->getDelegate()->getStyle('A8:L8')->getFont()->setBold(true);
                $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
            },
        ];
    }
}
