<?php

namespace App\Livewire\Admin\Pages\Orders\Partials;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\Order;
use App\Models\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Orders\GetData;
use Illuminate\Support\Facades\Auth;

class Delete extends Component
{
    use LivewireAlert;

    public $order;
    public $code;

    public function mount($order)
    {
        $this->order = $order;
    }

    protected $listeners = ['orderDelete'];

    public function orderDelete($id)
    {
        $this->order = Order::find($id);
    
        if (!$this->order) {
            // Alert 
            showAlert($this, 'error', 'Purchase not found');
        }
    
        // Set the properties
        $this->code = $this->order->code;
    
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
            foreach ($this->order->products as $product) {
                $product->delete();
            }
            $this->order->delete();

            DB::commit(); // All database operations are successful, commit the transaction            

            // Hide modal
            $this->dispatch('deleteModalToggle');

            // Refresh skills data component
            return redirect()->route('admin.orders.index');
            
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
        return view('admin.pages.orders.partials.delete');
    }
}
