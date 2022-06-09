<?php

namespace App\Exports;

use App\Models\Asset;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class AssetExportView implements FromView, WithDrawings, ShouldAutoSize
{

    public function view(): View
    {
        $assets = Asset::get();
        return view('export.asset', compact('assets'));
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('ATL Logo');
        $drawing->setPath(public_path('/assets/img/logo.png'));
        $drawing->setHeight(50);
        $drawing->setCoordinates('A1');
        $drawing->setOffsetX(150);
        $drawing->setOffsetY(300);
        $drawing->getShadow()->setVisible(true);
        $drawing->getShadow()->setDirection(35);

        return $drawing;
    }
}
