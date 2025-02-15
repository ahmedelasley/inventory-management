<?php

namespace App\Livewire\Admin\Pages\Roles\Managers;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Livewire\WithFileUploads;
use Livewire\WithPagination;

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
        'roleShow' => '$refresh',
        'roleUpdate' => '$refresh',
        'roleDelete' => '$refresh',
    ];


    public function render()
    {

        $data = Role::where('guard_name', 'manager')->where($this->field, 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate);
        // $groups = Permission::where('guard_name', 'admin')->get();

        return view('admin.pages.roles.managers.get-data', [
            'data' => $data,
            // 'groups' => $groups,
        ]);
    }
}
