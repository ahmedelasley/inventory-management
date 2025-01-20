<?php

namespace App\Livewire\Admin\Pages\Keepers;

use Livewire\Component;
use App\Models\Keeper;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exports\KeepersExport;
// use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
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
        'keeperAssignRole' => '$refresh',
        'keeperShow' => '$refresh',
        'keeperVerify' => '$refresh',
        'keeperUpdate' => '$refresh',
        'keeperDelete' => '$refresh',
    ];


    public function render()
    {
        $data = Keeper::with(['creator', 'updater', 'warehouse'])->where($this->field, 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate);
        return view('admin.pages.keepers.get-data', [
            'data' => $data,
        ]);
    }
}
