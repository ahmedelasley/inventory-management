<?php

namespace App\Livewire\Manager\Pages\Orders\Partials;

use Livewire\Component;

use Livewire\WithPagination;


class Cart extends Component
{
    use  WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $order;

    protected $listeners = [
        'addItem' => '$refresh',
        'editModalToggle' =>'$refresh',
        'deleteModalToggle' =>'$refresh',
        'editOrderModalToggle' =>'$refresh',
        'sendOrderModalToggle' =>'$refresh',
        'processedOrderModalToggle' =>'$refresh',
        'shippedOrderModalToggle' =>'$refresh',
        'saveOrderModalToggle' =>'$refresh',
        'convertOrderModalToggle' =>'$refresh',
    ];


    public function render()
    {

        return view('manager.pages.orders.partials.cart');
    }
}
