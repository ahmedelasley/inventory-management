<?php

namespace App\Livewire\Admin\Pages\Sales;

use Livewire\Component;
use App\Models\Supervisor;
use App\Models\Sale;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exports\SalesExport;
use App\Imports\SalesImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
// use Maatwebsite\Excel\Excel as ExcelType;
use Mpdf\Mpdf;

class GetData extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $field = 'code';
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
        'saleShow' => '$refresh',
        'saleDelete' => '$refresh',
    ];

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('deleteSelectedModalToggle');
    }

 



    public function exportExcel()
    {
        // Alert 
        showAlert($this, 'success', __('Downloading Data Successfully'));

        return Excel::download(new SalesExport, 'Sales.xlsx');
        
    }
    public function exportPDF()
    {
        // Alert 
        showAlert($this, 'success', __('Downloading Data Successfully'));

        return Excel::download(new SalesExport, 'Sales.pdf', \Maatwebsite\Excel\Excel::MPDF);
        
    }



    public function render()
    {
        // $data = Purchase::with(['warehouse', 'supplier', 'createable'])->where($this->field, 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate);



        $data = Sale::with(['restaurant', 'client', 'creator']);

        if ($this->field == 'restaurant') {
            $data = $data->whereHas('restaurant', function ($query) { $query->where('name', 'like', '%' . $this->search . '%'); });
        } else if ($this->field == 'client') {
            $data = $data->whereHas('client', function ($query) { $query->where('name', 'like', '%' . $this->search . '%'); });
        } else {
            $data = $data->where($this->field, 'like', '%' . $this->search . '%');
        }    

         $data = $data->latest()->paginate($this->paginate);



        return view('admin.pages.sales.get-data', [
            'data' => $data,
        ]);
    }
}
