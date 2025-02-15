<?php

namespace App\Livewire\Admin\Pages\Purchases\Partials;

use Livewire\Component;
use App\Models\Product;
use App\Models\PurchaseItems;

use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
// use Livewire\Attributes\On; 


class Cart extends Component
{
    use  WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $purchase;

    protected $listeners = [
        'addItem' => '$refresh',
        'editItemModalToggle' =>'$refresh',
        'deleteItemModalToggle' =>'$refresh',
        'editPurchaseModalToggle' =>'$refresh',
        'savePurchaseModalToggle' =>'$refresh',
        'convertPurchaseModalToggle' =>'$refresh',
    ];










    
    







    // #[On('addItem')] 
    public function render()
    {

        return view('admin.pages.purchases.partials.cart');
    }
}
