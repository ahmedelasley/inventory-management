<?php

namespace App\Imports;

use App\Models\Product;
// use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use Illuminate\Support\Facades\Auth;

class ProductsImport implements ToModel, WithHeadingRow, WithSkipDuplicates
{

    public function model(array $row)
    {

        if ($this->isEmptyRow($row)) {
            return null; // تجاهل الصف الفارغ
        }


        return new Product([
            'name'                      => $row['name'],
            'name_localized'            => $row['name_localized'],
            'sku'                       => $row['sku'],
            // 'sku'                       => 'sku-' . (Product::count() == 0 ? '10001' : (int) str_replace('sku-', '', Product::latest()->first()->sku) + 1 ),
            'description'               => $row['description'],
            'storge_unit'               => $row['storge_unit'],
            'intgredtiant_unit'         => $row['intgredtiant_unit'],
            'storage_to_intgredient'    => $row['storage_to_intgredient'],
            'costing_method'            => $row['costing_method'],
            'category_id'               => $row['category_id'],
            'created_id'                => Auth::guard('admin')->user()->id, // Ensure this is not null
        ]);
    }

    // public function uniqueBy()
    // {
    //     return ['name']; // Ensures uniqueness by both email and phone

    // }

    private function isEmptyRow($row)
    {
        return empty(array_filter($row)); // يتحقق من أن جميع الحقول فارغة
    }
}
