<?php

namespace App\Livewire\Supervisor\Pages\Orders\Partials;

use Livewire\Component;
use App\Models\Product;

use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class Title extends Component
{
    use  WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $order;
    protected $listeners = [
        'refreshTitle' => '$refresh',
        // 'editModalToggle' =>'$refresh',
        // 'deleteModalToggle' =>'$refresh',
        // 'editPurchaseModalToggle' =>'$refresh',
        // 'savePurchaseModalToggle' =>'$refresh',
    ];

    public function render()
    {
        return view('supervisor.pages.orders.partials.title');
    }
}
