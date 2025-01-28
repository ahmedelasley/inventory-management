<?php

namespace App\Livewire\Keeper\Pages\Purchases\Partials;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\Purchase;
use App\Models\Keeper;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Keeper\Pages\Purchases\GetData;
use Illuminate\Support\Facades\Auth;

class Delete extends Component
{
    use LivewireAlert;

    public $purchase;
    public $code;

    public function mount($purchase)
    {
        $this->purchase = $purchase;
    }

    protected $listeners = ['purchaseDelete'];

    public function purchaseDelete($id)
    {
        $this->purchase = Purchase::find($id);
    
        if (!$this->purchase) {
            // Alert 
            showAlert($this, 'error', 'Purchase not found');
        }
    
        // Set the properties
        $this->code = $this->purchase->code;
    
        // Open modal
        $this->dispatch('deletePurchaseModalToggle');
    }

    public function closeForm()
    {
        // Close modal
        $this->dispatch('deletePurchaseModalToggle');
    }
    

    public function submit()
    {

        DB::beginTransaction();

        try {
   
            // Delete the selected rows
            foreach ($this->purchase->products as $product) {
                $product->delete();
            }
            $this->purchase->delete();

            DB::commit(); // All database operations are successful, commit the transaction            

            // Hide modal
            $this->dispatch('deletePurchaseModalToggle');

            // Refresh skills data component
            return redirect()->route('keeper.purchases.index');
            
            // Alert 
            showAlert($this, 'success', __('Done Delete Data Successfully'));

        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        }
    }



    public function render()
    {
        return view('keeper.pages.purchases.partials.delete');
    }
}
