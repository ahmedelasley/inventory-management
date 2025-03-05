<?php

namespace App\Livewire\Manager\Pages\Menus;

use Livewire\Component;
use App\Models\Category;
use App\Models\Menu;
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
        $this->paginate = 12;
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
        'menuShow' => '$refresh',
        'menuUpdate' => '$refresh',
        'menuDelete' => '$refresh',
        'refreshActive' => '$refresh',
        'refreshEdit' => '$refresh',

    ];


    public function render()
    {
        $data = Menu::with(['category', 'creator', 'editor']);

        if ($this->field == 'category') {
            $data = $data->whereHas('category', function ($query) { $query->where('name', 'like', '%' . $this->search . '%'); });
         } else {
            $data = $data->where($this->field, 'like', '%' . $this->search . '%');
         }        
         $data = $data->latest()->paginate($this->paginate);

        return view('manager.pages.menus.get-data', [
            'data' => $data,
        ]);
    }
}
