<?php

namespace App\Livewire\Admin\Pages\Orders\Partials;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItems;

use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;



class EditProduct extends Component
{
    use LivewireAlert;

    public $order;
    // public $purchase_id;
    public $item;
    public $type;
    
    public $name;
    public $sku;
    public float $quantity_request;
    public float $quantity_available;


  
    public function mount($order)
    {
        $this->order = $order;
        // $this->purchase_id = $purchase->id;
    }
    protected $listeners = ['orderItemUpdate'];

    public function orderItemUpdate($id)
    {
        // dump($id);
        $this->item = OrderItems::find($id);
    
        if (!$this->item) {
            // Alert 
            showAlert($this, 'error', 'Order not found');
        }
    
        // Set the properties
        $this->type                 = $this->item->order?->type;

        $this->name                 = $this->item->stock?->product?->name;
        $this->sku                  = $this->item->stock?->product?->sku;
        $this->quantity_request     = $this->item->quantity_request;
        $this->quantity_available   = $this->item->quantity_request;

    
    
        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('editModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('editModalToggle');
    }
    
    public function rules()
    {
        $this->rules = [
            'quantity_request' => 'required|numeric|decimal:0,4|gte:0',
            'quantity_available' => 'required|numeric|decimal:0,4|gte:0',
        ];

        return $this->rules;
    } 
 
    public function updated($field)
    {
        $this->validateOnly($field);
    }



    public function submit()
    {
        DB::beginTransaction();

        try {
            // Check of Validation
            $validatedData       = $this->validate();

            // Add updater
            // $validatedData['updated_id'] = Auth::guard('admin')->user()->id;
            
            $this->order = Order::find($this->item->order_id);

            $this->order->update([
                'quantities' => $this->order->quantities - $this->item->quantity_request + $validatedData['quantity_request'],
                // 'subtotal' => $this->purchase->subtotal - ($this->item->quantity * $this->item->cost ) + ($validatedData['quantity'] * $validatedData['cost'] ) ,
            ]);

            // Update the item
            $this->item->update($validatedData);

            // Add updater
            $service = Admin::find(Auth::guard('admin')->user()->id);
            $this->order->updateable()->associate($service);
            $this->order->save();  

            $this->reset();

            // Hide modal
            $this->dispatch('editModalToggle');

            // Refresh skills data component
            // $this->dispatch(['refreshData'])->to(Index::class);
            
            // Alert 
            showAlert($this, 'success', __('Done Added Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction     
            // return redirect()->route('admin.purchases.complete-create', ['purchase' => $purchase ]);
       
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        }
    }


    public function render()
    {
        return view('admin.pages.orders.partials.edit-product');
    }
}
