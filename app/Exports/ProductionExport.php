<?php

namespace App\Exports;

use App\Models\Production;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductionExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'No',
            'Shop order',
            'Subprocess',
            'OP',
            'Qty start',
            'Qty end',
            'Work center',
            'Estimasi',
            'Deskripsi',
            'Start',
            'End',
            'Dimulai oleh',
            'Di akhiri oleh',
            'Catatan'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Production::all()->makeHidden(['created_at','updated_at']);
    }
}
