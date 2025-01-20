<?php

namespace App\Imports;

use App\Models\Category;
// use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use Illuminate\Support\Facades\Auth;

class CategoriesImport implements ToModel, WithHeadingRow, WithSkipDuplicates
{

    public function model(array $row)
    {

        if ($this->isEmptyRow($row)) {
            return null; // تجاهل الصف الفارغ
        }


        return new Category([
            'name'                      => $row['name'],
            'description'               => $row['description'],
            'parent_id'               => $row['parent_id'],
            'is_default'               => $row['is_default'],
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
