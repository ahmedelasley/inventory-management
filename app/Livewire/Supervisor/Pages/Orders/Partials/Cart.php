<?php

namespace App\Livewire\Supervisor\Pages\Orders\Partials;

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
        'saveOrderModalToggle' =>'$refresh',
        'sendOrderModalToggle' =>'$refresh',
    ];


    public function render()
    {

        return view('supervisor.pages.orders.partials.cart');
    }
}
