<?php

namespace App\Livewire\Keeper\Pages\Orders\Partials;

use Livewire\Component;
use App\Models\Keeper;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItems;

use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;



class DeleteProduct extends Component
{
    use LivewireAlert;

    public $order;
    public $order_id;
    public $item;
    
    public $name;
    public $sku;
    public float $quantity_request;
    // public float $cost;
    // public float $total;
    // public $production_date;
    // public $expiration_date;
    // public $notes;

  
    public function mount($order)
    {
        $this->order = $order;
        $this->order_id = $order->id;
    }
    protected $listeners = ['orderItemDelete'];

    public function orderItemDelete($id)
    {
        // dump($id);
        $this->item = OrderItems::find($id);
    
        if (!$this->item) {
            // Alert 
            showAlert($this, 'error', 'Warehouse not found');
        }
    
        // Set the properties
        $this->name             = $this->item->stock?->product?->name;
        $this->sku              = $this->item->stock?->product?->sku;
        $this->quantity_request = $this->item->quantity_request;
        // $this->cost             = $this->item->cost;

        // $this->production_date  = $this->item->production_date;
        // $this->expiration_date  = $this->item->expiration_date;
        // $this->notes            = $this->item->notes;
    
    
        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('deleteModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('deleteModalToggle');
    }
    
    // public function rules()
    // {
    //     $this->rules = [
    //         'quantity' => 'required|numeric|decimal:0,4|gt:0',
    //         'cost' => 'required|numeric|decimal:0,4|gt:0',
    //         'production_date' => 'nullable|date|before_or_equal:today',
    //         'expiration_date' => 'nullable|date|after_or_equal:production_date',
    //     ];

    //     if ($this->production_date) {
    //         $this->rules['expiration_date'] = 'required|date|after_or_equal:production_date';
    //     }

    //     return $this->rules;
    // } 
 
    // public function updated($field)
    // {
    //     $this->validateOnly($field);
    // }



    public function submit()
    {
        // dump($this->quantity);





        DB::beginTransaction();

        try {
            // Check of Validation
            // $validatedData       = $this->validate();

            // Add updater
            // $validatedData['updated_id'] = Auth::guard('keeper')->user()->id;

            $this->order = Order::find($this->item->order_id);
            // $quantities = ($order->quantities - $this->item->quantity);
            // $subtotal = ;

            $this->order->update([
                'items' => $this->order->items - 1,
                'quantities' => $this->order->quantities - $this->item->quantity_request ,
                // 'subtotal' => $this->order->subtotal - ($this->item->quantity * $this->item->cost ) ,
            ]);

            // Query delete
            $this->item->delete();

            // Add updater
            $service = Keeper::find(Auth::guard('keeper')->user()->id);
            $this->order->updateable()->associate($service);
            $this->order->save(); 

            $this->reset();

            // Hide modal
            $this->dispatch('deleteModalToggle');

            // Refresh skills data component
            // $this->dispatch(['refreshData'])->to(Index::class);
            
            // Alert 
            showAlert($this, 'success', __('Done Added Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction     
            // return redirect()->route('keeper.orders.complete-create', ['order' => $order ]);
       
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        }
    }


    public function render()
    {
        return view('keeper.pages.orders.partials.delete-product');
    }
}
