<?php

namespace App\Livewire\Admin\Pages\Purchases;

use Livewire\Component;
use App\Models\Supervisor;
use App\Models\Purchase;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exports\PurchasesExport;
use App\Imports\PurchasesImport;
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
    public $selectedRows = [];
    public $selectAllStatus = false;
    public $file;

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
        'purchaseShow' => '$refresh',
        // 'purchaseUpdate' => '$refresh',
        'purchaseDelete' => '$refresh',
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

    public function selectAll()
    {
        if ($this->selectAllStatus)  {
            $this->selectedRows = Purchase::pluck('id')->toArray(); // Selected all Rows
        } else {
            $this->selectedRows = []; // Not Selected all Rows
        }
        // $this->selectedRows = $this->selectedRows ? [] : Purchase::pluck('id')->toArray();

    }


    public function deleteSelected()
    {
        DB::beginTransaction();

        try {

            // Delete the selected rows
            Purchase::whereIn('id', $this->selectedRows)->delete();

            // Reset the selection
            $this->selectedRows = [];
            $this->selectAllStatus = false;
            // $this->showDeleteModal = false;
            $this->dispatch('deleteSelectedModalToggle');

            // Alert 
            showAlert($this, 'success', __('Done Deleted Selected Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction            
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        } 
    }

    public function exportExcel()
    {
        // Alert 
        showAlert($this, 'success', __('Downloading Data Successfully'));

        return Excel::download(new PurchasesExport, 'Purchases.xlsx');
        
    }
    public function exportPDF()
    {
        // Alert 
        showAlert($this, 'success', __('Downloading Data Successfully'));

        return Excel::download(new PurchasesExport, 'Purchases.pdf', \Maatwebsite\Excel\Excel::MPDF);
        
    }


    public function updatedFile()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',  // Ensure file validation
        ]);
    }

    public function importExcel()
    {
        try {
            // Validate the file before import
            $this->validate([
                'file' => 'required|file|mimes:xlsx,xls,csv',
            ]);
    
            // Import the file
            Excel::import(new PurchasesImport, $this->file);
            // $this->dispatch('importModalToggle');

            // Success Alert
            showAlert($this, 'success', __('Data Imported Successfully'));
        } catch (\Exception $e) {
            // Handle any exceptions
            if ($e->getCode() == 23000) { // Integrity constraint violation
                showAlert($this, 'error', __('Duplicate found.'));

            } else {
                showAlert($this, 'error', __('An error occurred: ') . $e->getMessage());
            }
        }
        $this->dispatch('importModalToggle');

    }
    public function closeFormImportExcel()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('importModalToggle');
    }

    public function render()
    {
        // $data = Purchase::with(['warehouse', 'supplier', 'createable'])->where($this->field, 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate);



        $data = Purchase::with(['warehouse', 'supplier', 'createable']);

        if ($this->field == 'warehouse') {
            $data = $data->whereHas('warehouse', function ($query) { $query->where('name', 'like', '%' . $this->search . '%'); });
        } else if ($this->field == 'supplier') {
            $data = $data->whereHas('supplier', function ($query) { $query->where('name', 'like', '%' . $this->search . '%'); });
        } else {
            $data = $data->where($this->field, 'like', '%' . $this->search . '%');
        }    

         $data = $data->latest()->paginate($this->paginate);



        return view('admin.pages.purchases.get-data', [
            'data' => $data,
        ]);
    }
}
