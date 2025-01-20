<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Illuminate\Support\Facades\Auth;

class CategoriesImport1 implements ToModel , WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
            'name'=> $row['name'],
            'description'=> $row['description'],
            'parent_id'=> $row['parent_id'],
            'created_id' => Auth::guard('admin')->user()->id, // Ensure this is not null
        ]);
    }

    public function uniqueBy()
    {
        return 'name';
    }
}
