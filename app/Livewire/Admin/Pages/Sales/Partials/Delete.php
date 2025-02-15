<?php

namespace App\Livewire\Admin\Pages\Sales\Partials;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\Sale;
use App\Models\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Sales\GetData;
use Illuminate\Support\Facades\Auth;

class Delete extends Component
{
    use LivewireAlert;

    public $sale;
    public $code;

    public function mount($sale)
    {
        $this->sale = $sale;
    }

    protected $listeners = ['saleDelete'];

    public function saleDelete($id)
    {
        $this->sale = Sale::find($id);
    
        if (!$this->sale) {
            // Alert 
            showAlert($this, 'error', 'sale not found');
        }
    
        // Set the properties
        $this->code = $this->sale->code;
    
        // Open modal
        $this->dispatch('deleteModalToggle');
    }

    public function closeForm()
    {
        // Close modal
        $this->dispatch('deleteModalToggle');
    }
    

    public function submit()
    {

        DB::beginTransaction();

        try {
   
            // Delete the selected rows
            foreach ($this->sale->products as $product) {
                $product->delete();
            }
            $this->sale->delete();

            DB::commit(); // All database operations are successful, commit the transaction            

            // Hide modal
            $this->dispatch('deleteModalToggle');

            // Refresh skills data component
            return redirect()->route('admin.sales.index');
            
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
        return view('admin.pages.sales.partials.delete');
    }
}
