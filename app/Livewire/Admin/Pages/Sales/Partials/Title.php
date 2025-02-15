<?php

namespace App\Livewire\Admin\Pages\Sales\Partials;

use Livewire\Component;
use App\Models\Product;

use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class Title extends Component
{
    use  WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $sale;
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
        return view('admin.pages.sales.partials.title');
    }
}
