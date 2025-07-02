<?php

namespace App\Exports;

use App\Models\WarehouseStock;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;


class InventoryWarehouseExport implements FromQuery, WithHeadings, WithMapping, ShouldQueue
{
    use Exportable;

    protected $sort = 1;
    protected $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }


    public function query()
    {

        $data = WarehouseStock::with(['product', 'warehouse'])->ofWarehouse($this->id)->latest();

        return $data;


    }


    /**
     * Write code on Method
     *
     * @return response()
     */

     public function headings(): array
     {
         return [
            '#',
            'Name',
            'SKU',
            'Live Qty Stock',
            'Intgredient',
            'Cost',
            'Total',
         ];
     }

        public function map($data): array
    {
        return [
            $this->sort++,
            $data->product->name,
            $data->product->sku,
            $data->quantity . ' ' . $data->product->storge_unit ,
            $data->quantity * $data->product->storage_to_intgredient . $data->product->intgredtiant_unit ,
            $data->cost,
            ($data->quantity == 0 ? '0' : $data->quantity * $data->cost ),
        ];
    }
}
