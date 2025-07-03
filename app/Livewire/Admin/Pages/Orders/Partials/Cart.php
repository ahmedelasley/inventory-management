<?php

namespace App\Livewire\Admin\Pages\Orders\Partials;

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
        'deleteItemModalToggle' =>'$refresh',
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

        return view('admin.pages.orders.partials.cart');
    }
}
