<?php

namespace App\Exports;

use App\Models\Product;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;


class ProductsExport implements FromQuery, WithHeadings, ShouldQueue
{
    use Exportable;

    public function query()
    {
        return Product::query();
    }
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Product::all();
    // }

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
            'name_localized',
            'sku',
            'description',
            'storge_unit',
            'intgredtiant_unit',
            'storage_to_intgredient',
            'costing_method',
            'category_id',
            'created_id',
            'updated_id',
            'created_at',
            'updated_at',
         ];
     }
}
