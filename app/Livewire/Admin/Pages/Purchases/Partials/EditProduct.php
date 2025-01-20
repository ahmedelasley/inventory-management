<?php

namespace App\Livewire\Admin\Pages\Purchases\Partials;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItems;

use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;



class EditProduct extends Component
{
    use LivewireAlert;

    public $purchase;
    public $purchase_id;
    public $item;
    
    public $name;
    public $sku;
    public float $quantity;
    public float $cost;
    public float $total;
    public $production_date;
    public $expiration_date;
    public $notes;

  
    public function mount($purchase)
    {
        $this->purchase = $purchase;
        $this->purchase_id = $purchase->id;
    }
    protected $listeners = ['purchaseItemUpdate'];

    public function purchaseItemUpdate($id)
    {
        // dump($id);
        $this->item = PurchaseItems::find($id);
    
        if (!$this->item) {
            // Alert 
            showAlert($this, 'error', 'Warehouse not found');
        }
    
        // Set the properties
        $this->name             = $this->item->product?->name;
        $this->sku             = $this->item->product?->sku;
        $this->quantity         = $this->item->quantity;
        $this->cost             = $this->item->cost;

        $this->production_date  = $this->item->production_date;
        $this->expiration_date  = $this->item->expiration_date;
        $this->notes            = $this->item->notes;
    
    
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
            'quantity' => 'required|numeric|decimal:0,4|gt:0',
            'cost' => 'required|numeric|decimal:0,4|gt:0',
            'production_date' => 'nullable|date|before_or_equal:today',
            'expiration_date' => 'nullable|date|after_or_equal:production_date',
        ];

        if ($this->production_date) {
            $this->rules['expiration_date'] = 'required|date|after_or_equal:production_date';
        }

        return $this->rules;
    } 
 
    public function updated($field)
    {
        $this->validateOnly($field);
    }



    public function submit()
    {
        // dump($this->quantity);





        DB::beginTransaction();

        try {
            // Check of Validation
            $validatedData       = $this->validate();

            // Add updater
            // $validatedData['updated_id'] = Auth::guard('admin')->user()->id;

            $this->purchase = Purchase::find($this->item->purchase_id);
            // $quantities = ($purchase->quantities - $this->item->quantity);
            // $subtotal = ;

            $this->purchase->update([
                'quantities' => $this->purchase->quantities - $this->item->quantity + $validatedData['quantity'],
                'subtotal' => $this->purchase->subtotal - ($this->item->quantity * $this->item->cost ) + ($validatedData['quantity'] * $validatedData['cost'] ) ,
            ]);


            // Update the item
            $this->item->update($validatedData);

            // Add updater
            $service = Admin::find(Auth::guard('admin')->user()->id);
            $this->purchase->updateable()->associate($service);
            $this->purchase->save();  

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
        return view('admin.pages.purchases.partials.edit-product');
    }
}
