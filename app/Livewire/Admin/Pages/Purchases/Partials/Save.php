<?php

namespace App\Livewire\Admin\Pages\Purchases\Partials;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use App\Models\WarehouseStockMovement;
use App\Models\Purchase;
use App\Models\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Purchases\GetData;
use Illuminate\Support\Facades\Auth;

class Save extends Component
{
    use LivewireAlert;

    public $purchase;

    public $code;
    public $type;

    public function mount($purchase)
    {
        $this->purchase = $purchase;
    }

    protected $listeners = ['purchaseSave'];

    public function purchaseSave($id)
    {
        $this->purchase = Purchase::find($id);
    
        if (!$this->purchase) {
            // Alert 
            showAlert($this, 'error', 'Purchase not found');
        }
    
        // Set the properties
        $this->code    = $this->purchase->code;
        $this->type  = $this->purchase->type;

        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('savePurchaseModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('savePurchaseModalToggle');
    }
    
    public function rules()
    {
        return [
            'type' => 'required|in:Draft,Purchasing,Return',
            // 'status' => 'required|in:Pending,Closed',
        ];
    } 
 
    public function updated($field)
    {
        $this->validateOnly($field);
    }



    public function submit()
    {

        // dd($this->purchase, $this->type);  
        DB::beginTransaction();

        try {
            // Check of Validation
            $validatedData       = $this->validate();

            // Add updater
            $service = Admin::find(Auth::guard('admin')->user()->id);
            
            // Update purchase
            $this->purchase->type   = $validatedData['type'];
            $this->purchase->status = 'Closed';

            $this->purchase->updateable()->associate($service);
            $this->purchase->save(); 
            
            //get warehouse 
            $warehouse = Warehouse::find($this->purchase->warehouse_id );

            if ($this->purchase->type == 'Purchasing') {
                // Handle purchasing logic
                foreach($this->purchase->products as $product) {

                    // Save warehouse stock
                    $warehouseStock = WarehouseStock::where('product_id', $product->product_id)->where('warehouse_id', $this->purchase->warehouse_id)->first();
                    if ($warehouseStock) {
                        $warehouseStock->quantity        += $product->quantity;
                        $warehouseStock->cost            = $product->cost;
                        $warehouseStock->production_date = $product->production_date;
                        $warehouseStock->expiration_date = $product->expiration_date;
                        $warehouseStock->save();
                    } else {
                        $warehouseStock = new WarehouseStock();
                        $warehouseStock->warehouse_id         = $warehouse->id;
                        $warehouseStock->product_id         = $product->product_id;
                        $warehouseStock->quantity           = $product->quantity;
                        $warehouseStock->cost               = $product->cost;
                        $warehouseStock->production_date    = $product->production_date;
                        $warehouseStock->expiration_date    = $product->expiration_date;
                        $warehouseStock->notes              = 'Purchasing';
                        $warehouseStock->createable()->associate($service);
                        $warehouseStock->save();
                    }

                    // Save warehouse stock movements
                    $warehouseStockMovement = new WarehouseStockMovement();
                    $warehouseStockMovement->warehouse_stock_id = $warehouseStock->id;
                    $warehouseStockMovement->type = 'Add';
                    $warehouseStockMovement->date = now();
                    $warehouseStockMovement->quantity = $product->quantity;
                    $warehouseStockMovement->notes = 'Purchasing';
                    $warehouseStockMovement->createable()->associate($service);
                    $warehouseStockMovement->save();
                }


            } else if ($this->purchase->type == 'Return') {
                // Handle return logic
                foreach ($this->purchase->products as $product) {
                    $warehouseStock = WarehouseStock::where('product_id', $product->product_id)->where('warehouse_id', $this->purchase->warehouse_id)->first();
                    if ($warehouseStock) {
                        $warehouseStock->quantity -= $product->quantity;
                        $warehouseStock->save();
                    }

                    // Save warehouse stock movements
                    $warehouseStockMovement = new WarehouseStockMovement();
                    $warehouseStockMovement->warehouse_stock_id = $warehouseStock->id;
                    $warehouseStockMovement->type = 'Return';
                    $warehouseStockMovement->date = now();
                    $warehouseStockMovement->quantity = $product->quantity;
                    $warehouseStockMovement->notes = 'Return';
                    $warehouseStockMovement->createable()->associate($service);
                    $warehouseStockMovement->save();
                }
            }







            $this->reset();

            // Hide modal
            $this->dispatch('savePurchaseModalToggle');
            $this->dispatch('refreshTitle'); 

            // Refresh skills data component
            // $this->dispatch(['refreshData'])->to(GetData::class);
            
            // Alert 
            showAlert($this, 'success', __('Done Saved Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction            
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        }
    }



    public function render()
    {
        return view('admin.pages.Purchases.partials.save');
    }
}
