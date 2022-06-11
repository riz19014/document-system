<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\DmFileUpload;


class DuplicateExport implements  FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function view(): View
    {
        $duplicates = DmFileUpload::whereIn('doc_name', function ( $query ) {
            $query->select('doc_name')->from('dm_file_uploads')->groupBy('doc_name')->havingRaw('count(*) > 1');
        })->get();

        return view('exports.duplicate', ['duplicates' => $duplicates]);
    }

     public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            },
        ];
    }
}