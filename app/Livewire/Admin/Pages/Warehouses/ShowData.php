<?php

namespace App\Livewire\Admin\Pages\Warehouses;

use Livewire\Component;
use App\Models\Supervisor;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exports\WarehousesExport;
use App\Exports\InventoryWarehouseExport;

use App\Imports\WarehousesImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
// use Maatwebsite\Excel\Excel as ExcelType;
use Mpdf\Mpdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class ShowData extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $field = 'name';
    public $paginate;
    public $id;


    protected function queryString()
    {
        return [
            'search' => [
                'except' => '',
                'as' => 'q',
            ],
            'paginate' => [
                'except' => 1,
            ],
        ];
    }

    public function mount()
    {
        // $this->data->here($this->field, 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate);
        $this->paginate = getSetting('pagination');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingPaginate()
    {
        $this->resetPage();
    }

    public function searchField($searchField)
    {
        $this->field = $searchField;
    }




    public function exportExcel()
    {
        // Alert 
        showAlert($this, 'success', __('Downloading Data Successfully'));

        $warehouseName = Warehouse::find($this->id)->name;
        $fileName = 'Inventory ( '. $warehouseName . ' ) '. Carbon::now()->format('Y-m-d H-i-s a') . '.xlsx';



        return Excel::download(new InventoryWarehouseExport($this->id), $fileName);

        // (new InventoryWarehouseExport($this->id))->queue($fileName);

        // Excel::queue(new InventoryWarehouseExport($this->id), 'exports/' . $fileName, 'public')
        //     ->chain([
        //         function () use ($fileName) {
        //             $downloadUrl = Storage::disk('public')->url('exports/' . $fileName);

        //             // إطلاق حدث للواجهة
        //             // $this->dispatch('download-file', ['url' => $downloadUrl]);
        //             $this->dispatch('download-file', url: $downloadUrl);

        //         }
        // ]);


    }
    public function exportPDF()
    {
        // Alert 
        showAlert($this, 'success', __('Downloading Data Successfully'));
        $warehouseName = Warehouse::find($this->id)->name;

        $fileName = 'Inventory ( '. $warehouseName . ' ) '. Carbon::now()->format('Y-m-d H-i-s a') . '.pdf';

        return Excel::download(new InventoryWarehouseExport($this->id), $fileName, \Maatwebsite\Excel\Excel::MPDF);
        
    }






    


    public function render()
    {
        $data = WarehouseStock::with(['product', 'warehouse'])->ofWarehouse($this->id);
        if ($this->field == 'name') {
            $data = $data->whereHas('product', function ($query) { $query->where('name', 'like', '%' . $this->search . '%'); });
        } else if ($this->field == 'code') {
            $data = $data->whereHas('product', function ($query) { $query->where('sku', 'like', '%' . $this->search . '%'); });
        } else {
            $data = $data->where($this->field, 'like', '%' . $this->search . '%');
         }        
         $data = $data->latest()->paginate($this->paginate);

        return view('admin.pages.warehouses.show-data', [
            'data' => $data,
        ]);    
    }
}
