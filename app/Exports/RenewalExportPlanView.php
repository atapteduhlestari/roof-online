<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class RenewalExportPlanView implements
    FromView,
    WithProperties,
    WithEvents,
    ShouldAutoSize
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $transactions = $this->data;
        return view('export.plan.renewal', compact('transactions'));
    }

    public function properties(): array
    {
        return [
            'creator'        => 'IT - Edward',
            'lastModifiedBy' => 'Administrator',
            'title'          => 'Renewal Detail Report',
            'description'    => 'Renewal Detail Report',
            'subject'        => 'Renewal Detail Report',
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
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    ],
                ];
                $cellRange = 'A1:B3';
                $sheet = $event->sheet;

                $sheet->getStyle('A8:I8')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('E5E4E2');
                $sheet->getDelegate()->getStyle('A8:I8')->getFont()->setBold(true);
                $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
            },
        ];
    }
}
