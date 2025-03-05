<?php

namespace App\Livewire\Manager\Pages\Sales\Partials;

use Livewire\Component;
use App\Models\Sale;
use App\Models\SaleItems;

use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class Cart extends Component
{
    use  WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $sale;


    protected $listeners = [
        'addItem' => '$refresh',
        // 'editModalToggle' =>'$refresh',
        'deleteItemModalToggle' =>'$refresh',
        'editSaleModalToggle' =>'$refresh',
        'saveSaleModalToggle' =>'$refresh',
        'increase' =>'$refresh',
        'decrease' =>'$refresh',
    ];

    public function increase(Sale $sale, SaleItems $item)
    {
        DB::beginTransaction();
        try {
            $sale->update([
                'quantities' => $sale->quantities + 1,
                'subtotal' => $sale->subtotal + $item->cost,
            ]);

            $item->update([
                'quantity' => $item->quantity + 1,
            ]);

            $this->dispatch('increase');

            // Commit transaction
            DB::commit();
        } catch (Exception $e) {

            // Rollback transaction on error
            DB::rollBack();

            // Alert error
            showAlert($this, 'error', $e->getMessage());
        }
    }

    public function decrease(Sale $sale, SaleItems $item)
    {
        DB::beginTransaction();
        try {
            $sale->update([
                'quantities' => $sale->quantities - 1,
                'subtotal' => $sale->subtotal - ($item->cost),

            ]);

            $item->update([
                'quantity' => $item->quantity - 1,
            ]);

            $this->dispatch('decrease');

            // Commit transaction
            DB::commit();
        } catch (Exception $e) {

            // Rollback transaction on error
            DB::rollBack();

            // Alert error
            showAlert($this, 'error', $e->getMessage());
        }
    }



    public function render()
    {

        return view('manager.pages.sales.partials.cart');
    }
}
