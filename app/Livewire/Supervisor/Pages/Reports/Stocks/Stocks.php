<?php

namespace App\Livewire\Supervisor\Pages\Reports\Stocks;

use Livewire\Component;

use App\Models\KitchenStock;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Stocks extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $type;
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
        $this->type = "All";
        $this->status =  "All";
        $this->fromDate = date('Y-m-d H:i:s');
        $this->toDate = date('Y-m-d H:i:s');
        $this->paginate = getSetting('pagination');
    }

    public function updatingPaginate()
    {
        $this->resetPage();
    }
    
    public function clearFilter()
    {
        $this->type = "All";
        $this->status =  "All";
        $this->fromDate = date('Y-m-d H:i:s');
        $this->toDate = date('Y-m-d H:i:s');

    }

    public function render()
    {
        $data = KitchenStock::with(['createable', 'product', 'kitchen', 'movements'])->ofKitchen(Auth::guard('supervisor')->user()->kitchen->id);

        // if ($this->type != 'All') {
        //     $data = $data->whereHas('kitchenStock', function ($query) {
        //         $query->where('product_id', 'like', '%' . $this->type . '%'); 
        //     });
        //  }   
        //  if ($this->status != 'All') {
        //     $data = $data->where('type', 'like', '%' . $this->status . '%');
        //  }   
         
        $data = $data->whereBetween('created_at', [$this->fromDate, $this->toDate])->latest()->paginate($this->paginate);

        return view('supervisor.pages.reports.stocks.stocks', [
            'data' => $data,
        ]);
    }
}
