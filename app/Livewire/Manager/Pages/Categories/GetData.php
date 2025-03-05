<?php

namespace App\Livewire\Manager\Pages\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exports\CategoriesExport;
use App\Imports\CategoriesImport;
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
        'categoryUpdate' => '$refresh',
        'categoryDelete' => '$refresh',
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
            $this->selectedRows = Category::where('is_default', 0)->pluck('id')->toArray(); // Selected all Rows
        } else {
            $this->selectedRows = []; // Not Selected all Rows
        }
        // $this->selectedRows = $this->selectedRows ? [] : Category::pluck('id')->toArray();

    }


    public function deleteSelected()
    {
        DB::beginTransaction();

        try {

            // Delete the selected rows
            Category::whereIn('id', $this->selectedRows)->delete();

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

        return Excel::download(new CategoriesExport, 'categories.xlsx');
        
    }
    public function exportPDF()
    {
        // Alert 
        showAlert($this, 'success', __('Downloading Data Successfully'));

        return Excel::download(new CategoriesExport, 'categories.pdf', \Maatwebsite\Excel\Excel::MPDF);
        
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
            Excel::import(new CategoriesImport, $this->file->getRealPath());
            // $this->dispatch('importModalToggle');

            // Success Alert
            showAlert($this, 'success', __('Data Imported Successfully'));
        } catch (\Exception $e) {
            // Handle any exceptions
            showAlert($this, 'error', __('Error importing data: ') . $e->getMessage());
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
        $data = Category::with(['creator', 'updater', 'parent', 'children'])->where($this->field, 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate);
        return view('manager.pages.categories.get-data', [
            'data' => $data,
        ]);
    }
}
