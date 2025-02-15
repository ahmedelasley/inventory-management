<?php

namespace App\Livewire\Admin\Pages\Sales\Partials;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItems;

use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;



class DeleteProduct extends Component
{
    use LivewireAlert;

    public $sale;
    public $sale_id;
    public $item;
    
    public $name;
    public $sku;
    public float $quantity;
    // public float $cost;
    // public float $total;
    // public $production_date;
    // public $expiration_date;
    // public $notes;

  
    public function mount($sale)
    {
        $this->sale = $sale;
        $this->sale_id = $sale->id;
    }
    protected $listeners = ['saleItemDelete'];

    public function saleItemDelete($id)
    {
        // dump($id);
        $this->item = SaleItems::find($id);
    
        if (!$this->item) {
            // Alert 
            showAlert($this, 'error', 'Warehouse not found');
        }
    
        // Set the properties
        $this->name     = $this->item->menu?->name;
        $this->sku      = $this->item->menu?->sku;
        $this->quantity = $this->item->quantity;
        // $this->cost             = $this->item->cost;

        // $this->production_date  = $this->item->production_date;
        // $this->expiration_date  = $this->item->expiration_date;
        // $this->notes            = $this->item->notes;
    
    
        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('deleteItemModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('deleteItemModalToggle');
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
            // $validatedData['updated_id'] = Auth::guard('admin')->user()->id;

            $this->sale = Sale::find($this->item->sale_id);
            // $quantities = ($sale->quantities - $this->item->quantity);
            // $subtotal = ;

            $this->sale->update([
                'items' => $this->sale->items - 1,
                'quantities' => $this->sale->quantities - $this->item->quantity ,
                'subtotal' => $this->sale->subtotal - ( $this->item->quantity * $this->item->cost),

                // 'subtotal' => $this->sale->subtotal - ($this->item->quantity * $this->item->cost ) ,
            ]);

            // Query delete
            $this->item->delete();

            // Add updater
            $service = Admin::find(Auth::guard('admin')->user()->id);
            $this->sale->editor()->associate($service);
            $this->sale->save(); 

            $this->reset();

            // Hide modal
            $this->dispatch('deleteItemModalToggle');

            // Refresh skills data component
            // $this->dispatch(['refreshData'])->to(Index::class);
            
            // Alert 
            showAlert($this, 'success', __('Done Added Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction     
            // return redirect()->route('admin.sales.complete-create', ['sale' => $sale ]);
       
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        }
    }


    public function render()
    {
        return view('admin.pages.sales.partials.delete-product');
    }
}
