<?php

namespace App\Livewire\Manager\Pages\Orders\Partials;

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
        'refreshTitleSend' =>'$refresh',
        'refreshTitleProcessed' =>'$refresh',
        'refreshTitleShipped' =>'$refresh',
        'refreshTitleSave' =>'$refresh',
        // 'deleteModalToggle' =>'$refresh',
        // 'editPurchaseModalToggle' =>'$refresh',
        // 'savePurchaseModalToggle' =>'$refresh',
    ];

    public function render()
    {
        return view('manager.pages.orders.partials.title');
    }
}
