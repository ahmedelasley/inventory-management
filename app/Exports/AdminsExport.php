<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class AdminsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Admin::all();
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
            'email',
            'email_verified_at',
            'created_at',
            'updated_at',
         ];
     }
}
