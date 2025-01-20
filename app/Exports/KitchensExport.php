<?php

namespace App\Exports;

use App\Models\Kitchen;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;


class KitchensExport implements FromQuery, WithHeadings, ShouldQueue
{
    use Exportable;

    public function query()
    {
        return Kitchen::query();
    }


    /**
     * Write code on Method
     *
     * @return response()
     */

     public function headings(): array
     {
         return [
            'id',
            'name',
            'code',
            'location',
            'is_default',
            'supervisor_id',
            'created_id',
            'updated_id',
         ];
     }
}
