<?php

namespace App\Livewire\Admin\Pages\Clients;

use Livewire\Component;
use App\Models\Client;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exports\ClientsExport;

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
        'clientUpdate' => '$refresh',
        'clientDelete' => '$refresh',
    ];

    public function exportExcel()
    {
        // Alert 
        showAlert($this, 'success', __('Downloading Data Successfully'));

        return Excel::download(new ClientsExport, 'Clients.xlsx');
        
    }
    public function exportPDF()
    {
        // Alert 
        showAlert($this, 'success', __('Downloading Data Successfully'));

        return Excel::download(new ClientsExport, 'Clients.pdf', \Maatwebsite\Excel\Excel::MPDF);
        
    }
 

    public function render()
    {
        $data = Client::with(['creator', 'editor'])->where($this->field, 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate);
        return view('admin.pages.clients.get-data', [
            'data' => $data,
        ]);
    }
}
