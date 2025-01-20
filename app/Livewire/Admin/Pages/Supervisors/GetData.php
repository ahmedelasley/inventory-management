<?php

namespace App\Livewire\Admin\Pages\Supervisors;

use Livewire\Component;
use App\Models\Supervisor;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exports\SupervisorsExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use Mpdf\Mpdf;
use Spatie\Permission\Models\Role;

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

    public function mount()
    {
        $this->paginate = getSetting('pagination');
    }

 
    
    protected $listeners = [
        'refreshData' => '$refresh',
        'supervisorAssignRole' => '$refresh',
        'supervisorShow' => '$refresh',
        'supervisorVerify' => '$refresh',
        'supervisorUpdate' => '$refresh',
        'supervisorDelete' => '$refresh',
    ];


    public function render()
    {

        $data = Supervisor::with(['creator', 'updater', 'kitchen'])->where($this->field, 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate);
        return view('admin.pages.supervisors.get-data', [
            'data' => $data,
        ]);


    }
}
