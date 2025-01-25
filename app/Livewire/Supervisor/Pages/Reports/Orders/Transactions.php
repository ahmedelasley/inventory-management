<?php

namespace App\Livewire\Supervisor\Pages\Reports\Orders;

use Livewire\Component;

use App\Models\KitchenStockMovement;
use App\Models\KitchenStock;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Transactions extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $stocks;
    public $status ;
    public $fromDate;
    public $toDate;
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
        $this->stocks = "All";
        $this->status =  "All";
        $this->fromDate = now();
        $this->toDate = now();
        $this->paginate = getSetting('pagination');
    }

    public function updatingPaginate()
    {
        $this->resetPage();
    }

    public function clearFilter()
    {
        $this->stocks = "All";
        $this->status =  "All";
        $this->fromDate = now();
        $this->toDate = now();

    }
    
    public function render()
    {
        $data = KitchenStockMovement::with(['createable', 'kitchenStock']);

        if ($this->stocks != 'All') {
            $data = $data->whereHas('kitchenStock', function ($query) {
                $query->where('product_id', 'like', '%' . $this->stocks . '%'); 
            });
         }   
         if ($this->status != 'All') {
            $data = $data->where('type', 'like', '%' . $this->status . '%');
         }   

        $data = $data->whereBetween('created_at', [$this->fromDate, $this->toDate])->latest()->paginate($this->paginate);

         $products = KitchenStock::with('product')->get();
        return view('supervisor.pages.reports.orders.transactions', [
            'data' => $data,
            'products' => $products,
        ]);
    }
}
