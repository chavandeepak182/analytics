<?php

namespace App\Exports;

use Illuminate\Support\ServiceProvider;

use App\Models\Arm_reports;
// use Maatwebsite\Excel\Concerns\FromCollection;

// use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\Font;
// use \Maatwebsite\Excel\Sheet;
// use Maatwebsite\Excel\Excel;


class ExportReport implements  FromView,WithEvents,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // use Exportable;
    public function __construct($all_reports) {
        $this->all_reports = $all_reports;
    }

    public function view(): View
    {
        return view('admin.all_reports.exportReport', 
        [
            'all_reports' => $this->all_reports,
        ]);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:AG1')->applyFromArray([
                    'font' => [
                        'size' => 13,
                        'bold' => true
                    ],
                ]);
            },
        ];
    }
}
