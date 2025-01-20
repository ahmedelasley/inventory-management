<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use Illuminate\Support\Facades\Auth;
class SuppliersImport implements ToModel, WithUpserts, WithHeadingRow, WithSkipDuplicates
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if ($this->isEmptyRow($row)) {
            return null; // تجاهل الصف الفارغ
        }


        return new Supplier([
            'name' => $row['name'],
            'code' => $row['code'],
            // 'code' => Supplier::count() == 0 ? getSetting('supplier_code') + 1 : Supplier::latest()->first()->code + 1 ,
            'phone' => $row['phone'],
            'email' => $row['email'],
            'address' => $row['address'],
            'created_id' => Auth::guard('admin')->user()->id, // Ensure this is not null
        ]);
    }

    public function uniqueBy()
    {
        return ['name', 'code', 'phone', 'email']; // Ensures uniqueness by both email and phone

    }

    private function isEmptyRow($row)
    {
        return empty(array_filter($row)); // يتحقق من أن جميع الحقول فارغة
    }
}
