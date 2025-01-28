<?php

namespace App\Livewire\Keeper\Pages\Inventory;

use Livewire\Component;
use App\Models\keeper;
use App\Models\WarehouseStock;
use Illuminate\Support\Facades\Auth;

use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
// use Maatwebsite\Excel\Excel as ExcelType;
use Mpdf\Mpdf;

class GetData extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $field = 'name';
    public $paginate;

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

    
    protected $listeners = [
        'refreshData' => '$refresh',
        'warehouseShow' => '$refresh',
        'warehouseUpdate' => '$refresh',
        'warehouseDelete' => '$refresh',
    ];

    public function render()
    {
        $data = WarehouseStock::with(['createable', 'product', 'warehouse', 'movements'])->where('warehouse_id', Auth::guard('keeper')->user()->warehouse->id)->paginate(20);

        return view('keeper.pages.inventory.get-data', [
            'data' => $data,
        ]);
    }
}
