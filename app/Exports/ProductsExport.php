<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromQuery, WithHeadings, WithMapping, ShouldQueue
{
    use Exportable;

    protected $id = 1;

    public function query()
    {
        return Product::with(['category', 'creator', 'updater']);
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Name Localized',
            'SKU',
            'Description',
            'Storge Unit',
            'Intgredtiant Unit',
            'Storage To Intgredient',
            'Costing Method',
            'Category',
            'Creator',
            'Editor',
            'Created at',
            'Updated At',
        ];
    }

    public function map($product): array
    {
        return [
            $this->id++,
            $product->name,
            $product->name_localized,
            $product->sku,
            $product->description,
            $product->storge_unit,
            $product->intgredtiant_unit,
            $product->storage_to_intgredient,
            $product->costing_method,
            $product->category?->name,
            $product->creator?->name,
            $product->updater?->name,
            $product->created_at,
            $product->updated_at,
        ];
    }
}
