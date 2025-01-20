<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CategoriesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category::all();
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
            'description',
            'parent_id',
            'created_id',
            'updated_id',
            'created_at',
            'updated_at',
         ];
     }
}
