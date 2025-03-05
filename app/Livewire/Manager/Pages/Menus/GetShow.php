<?php

namespace App\Livewire\Manager\Pages\Menus;

use Livewire\Component;
use App\Models\Category;
use App\Models\Menu;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class GetShow extends Component
{
    use LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $field = 'name';
    public $paginate;
    public $menu;

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
        // 'refreshActive' => '$refresh',
    ];


    public function render()
    {
        return view('manager.pages.menus.get-show');
    }
}
