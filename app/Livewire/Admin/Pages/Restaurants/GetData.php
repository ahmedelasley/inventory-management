<?php

namespace App\Livewire\Admin\Pages\Restaurants;

use Livewire\Component;
use App\Models\Restaurant;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class GetData extends Component
{
    use LivewireAlert, WithPagination;
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
        'restaurantShow' => '$refresh',
        'restaurantUpdate' => '$refresh',
        'restaurantDelete' => '$refresh',
    ];

    public function render()
    {
        $data = Restaurant::with(['manager', 'creator', 'editor'])->where($this->field, 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate);
        return view('admin.pages.restaurants.get-data', [
            'data' => $data,
        ]);
    }
}
