<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;



class MaintenanceExportSummaryView implements
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
        $data = $this->data;
        return view('export.summary.maintenance', compact('data'));
    }

    public function properties(): array
    {
        return [
            'creator'        => 'IT - Edward',
            'lastModifiedBy' => 'Administrator',
            'title'          => 'maintenance Summary Report',
            'description'    => 'maintenance Summary Report',
            'subject'        => 'maintenance Summary Report',
            'category'       => 'Report',
            'company'        => 'PT. ATAP TEDUH LESTARI',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $styleArray = [
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                    ],
                ];

                $sheet = $event->sheet;
                $cellRange = 'A8:D1000';
                // $event->sheet->getDelegate()->getColumnDimension('A')->setAutoSize(true);
                // $sheet->getStyle('A7:D7')->getBorders()->getAllBorders()
                //     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $sheet->getStyle('A8:D8')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('E5E4E2');
                $sheet->getDelegate()->getStyle('A8:D8')->getFont()->setBold(true);
                $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
            },
        ];
    }

    // public function drawings()
    // {
    //     $drawing = new Drawing();
    //     $drawing->setName('Logo');
    //     $drawing->setDescription('ATL Logo');
    //     $drawing->setPath(public_path('/assets/img/logo.png'));
    //     $drawing->setHeight(50);
    //     $drawing->setCoordinates('A1');
    //     $drawing->setOffsetX(150);
    //     $drawing->setOffsetY(300);
    //     $drawing->getShadow()->setVisible(true);
    //     $drawing->getShadow()->setDirection(30);

    //     return $drawing;
    // }
}
