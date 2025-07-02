<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class CategoriesExport implements FromQuery, WithHeadings, WithMapping, ShouldQueue
{
    use Exportable;

    protected $id = 1;

    public function query()
    {
        return Category::with(['parent', 'creator', 'updater']);
    }
     public function headings(): array
     {
         return [
            '#',
            'Name',
            'Description',
            'Parent',
            'Type',
            'Creator',
            'Editor',
            'Created at',
            'Updated At',
         ];
     }
     
    public function map($category): array
    {
        return [
            $this->id++,
            $category->name,
            $category->description,
            $category->parent?->name,
            $category->type == 0 ? 'stock' : 'menu',
            $category->creator?->name,
            $category->updater?->name,
            $category->created_at,
            $category->updated_at,
        ];
    }
}
