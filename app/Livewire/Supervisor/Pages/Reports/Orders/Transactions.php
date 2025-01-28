<?php

namespace App\Livewire\Supervisor\Pages\Reports\Orders;

use Livewire\Component;

use App\Models\Order;
use App\Models\OrderStatus;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Transactions extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $order;
    public $oldStatus ;
    public $newStatus ;
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
        $this->order = "All";
        $this->oldStatus =  "All";
        $this->newStatus =  "All";
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
        $this->order = "All";
        $this->oldStatus =  "All";
        $this->newStatus =  "All";
        $this->fromDate = now();
        $this->toDate = now();

    }
    
    public function render()
    {
        $data = OrderStatus::with(['statusable', 'order'])->whereHas('order', function ($query) {
                                $query->ofKitchen(Auth::guard('supervisor')->user()->kitchen->id); 
                            });

        if ($this->order != 'All') {
            $data = $data->where('order_id', $this->order);
         }   
         if ($this->oldStatus != 'All') {
            $data = $data->where('old_status', $this->oldStatus);
         }   
         
         if ($this->newStatus != 'All') {
            $data = $data->where('new_status', $this->newStatus);
         }   
         
        $data = $data->whereBetween('created_at', [$this->fromDate, $this->toDate])->latest()->paginate($this->paginate);

         $orders = Order::ofKitchen(Auth::guard('supervisor')->user()->kitchen->id)->get();
        return view('supervisor.pages.reports.orders.transactions', [
            'data' => $data,
            'orders' => $orders,
        ]);
    }
}
