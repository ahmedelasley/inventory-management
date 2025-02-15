<?php

namespace App\Livewire\Admin\Pages\Warehouses;

use Livewire\Component;
use App\Models\Supervisor;
use App\Models\WarehouseStockMovement;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exports\WarehousesExport;
use App\Imports\WarehousesImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
// use Maatwebsite\Excel\Excel as ExcelType;
use Mpdf\Mpdf;

class ShowTransactionData extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $field = 'type';
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




    // public function exportExcel()
    // {
    //     // Alert 
    //     showAlert($this, 'success', __('Downloading Data Successfully'));

    //     return Excel::download(new WarehousesExport, 'Warehouses.xlsx');
        
    // }
    // public function exportPDF()
    // {
    //     // Alert 
    //     showAlert($this, 'success', __('Downloading Data Successfully'));

    //     return Excel::download(new WarehousesExport, 'Warehouses.pdf', \Maatwebsite\Excel\Excel::MPDF);
        
    // }





    


    public function render()
    {
        $data = WarehouseStockMovement::with(['warehouseStock', 'createable'])->where('warehouse_stock_id', $this->id)
                                        ->where($this->field, 'like', '%' . $this->search . '%')
                                        ->latest()->paginate($this->paginate);

        return view('admin.pages.warehouses.show-transaction-data', [
            'data' => $data,
        ]);    
    }
}
