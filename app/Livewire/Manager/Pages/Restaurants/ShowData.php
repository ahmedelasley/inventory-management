<?php

namespace App\Livewire\Manager\Pages\Restaurants;

use Livewire\Component;
use App\Models\Supervisor;
use App\Models\Kitchen;
use App\Models\Warehouse;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exports\RestaurantsExport;
use App\Imports\RestaurantsImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;


class ShowData extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $field = 'name';
    public $paginate;
    public $id;
    // public $kitchens;
    // public $warehouses;
    

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


    


    public function render()
    {
        // Get the restaurant's kitchens and warehouses
        $kitchens = Kitchen::with(['supervisor', 'creator', 'updater'])->where('restaurant_id', $this->id)->paginate($this->paginate);
        $warehouses = Warehouse::with(['keeper', 'creator', 'updater'])->where('restaurant_id', $this->id)->paginate($this->paginate);
        return view('manager.pages.restaurants.show-data',[
            'kitchens' => $kitchens,
            'warehouses' => $warehouses,
        ]);    
    }
}
