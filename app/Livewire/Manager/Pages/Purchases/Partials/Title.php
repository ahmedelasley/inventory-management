<?php

namespace App\Livewire\Manager\Pages\Purchases\Partials;

use Livewire\Component;
use App\Models\Product;
use App\Models\PurchaseItems;

use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On; 


class Title extends Component
{
    use  WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $purchase;
    protected $listeners = [
        'refreshTitle' => '$refresh',
        // 'editModalToggle' =>'$refresh',
        // 'deleteModalToggle' =>'$refresh',
        // 'editPurchaseModalToggle' =>'$refresh',
        // 'savePurchaseModalToggle' =>'$refresh',
    ];

    // #[On('savePurchaseModalToggle')] 
    public function render()
    {

        return view('manager.pages.purchases.partials.title');
    }
}
