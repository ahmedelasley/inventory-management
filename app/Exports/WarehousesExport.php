<?php

namespace App\Exports;

use App\Models\Warehouse;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;


class WarehousesExport implements FromQuery, WithHeadings, ShouldQueue
{
    use Exportable;

    public function query()
    {
        return Warehouse::query();
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
            'keeper_id',
            'created_id',
            'updated_id',
         ];
     }
}
