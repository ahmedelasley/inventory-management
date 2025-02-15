<?php

namespace App\Livewire\Admin\Pages\Sales\Partials;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use App\Models\WarehouseStockMovement;
use App\Models\Kitchen;
use App\Models\KitchenStock;
use App\Models\KitchenStockMovement;





use App\Models\Sale;
use App\Models\SaleStatus;
use App\Models\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Sales\GetData;
use Illuminate\Support\Facades\Auth;

class Shipped extends Component
{
    use LivewireAlert;

    public $sale;

    public $code;
    public $type;

    public function mount($sale)
    {
        $this->sale = $sale;
    }

    protected $listeners = ['saleShipped'];

    public function saleShipped($id)
    {
        $this->sale = Sale::find($id);
    
        if (!$this->sale) {
            // Alert 
            showAlert($this, 'error', 'Sale not found');
        }
    
        // Set the properties
        $this->code    = $this->sale->code;
        $this->type    = $this->sale->type;

        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('shippedSaleModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('shippedSaleModalToggle');
    }
    

    public function submit()
    {

        // dd($this->sale, $this->type);  
        DB::beginTransaction();

        try {
            // Add updater
            $service = Admin::find(Auth::guard('admin')->user()->id);
            
            // Save Sale Status
            $saleStatus = new SaleStatus();
            $saleStatus->sale_id = $this->sale->id;
            $saleStatus->old_status = $this->sale->type;
            $saleStatus->new_status = 'Shipped';
            $saleStatus->date = now();
            $saleStatus->statusable()->associate($service);
            $saleStatus->save();

            // 1- Update sale
            $this->sale->type   = 'Shipped';
            // $this->sale->status = 'Open';
            $this->sale->response_date   = now();

            $this->sale->updateable()->associate($service);
            $this->sale->save();

            
            //get warehouse 
            $warehouse = Warehouse::find($this->sale->warehouse_id );
            $kitchen = Kitchen::find($this->sale->kitchen_id );


            // Handle return logic
            foreach ($this->sale->products as $product) {

                $warehouseStock = WarehouseStock::where('id', $product->warehouse_stock_id)->where('warehouse_id', $this->sale->warehouse_id)->first();
                if ($warehouseStock) {
                    $warehouseStock->quantity -= $product->quantity_available;
                    $warehouseStock->save();
                }

                // Save warehouse stock movements
                $warehouseStockMovement = new WarehouseStockMovement();
                $warehouseStockMovement->warehouse_stock_id = $warehouseStock->id;
                $warehouseStockMovement->type = 'Reduce';
                $warehouseStockMovement->date = now();
                $warehouseStockMovement->quantity = $product->quantity_available;
                $warehouseStockMovement->notes = 'Reduce';
                $warehouseStockMovement->createable()->associate($service);
                $warehouseStockMovement->save();




                // $kitchenStock = KitchenStock::where('product_id', $product->product_id)->where('kitchen_id', $this->sale->kitchen_id)->first();
                // if ($kitchenStock) {
                //     $kitchenStock->quantity += $product->quantity_available;
                //     $kitchenStock->save();
                // } else {
                //     $kitchenStock = new KitchenStock();
                //     $kitchenStock->kitchen_id = $kitchen->id;
                //     $kitchenStock->product_id = $product->product_id;
                //     $kitchenStock->quantity = $product->quantity_available;
                //     $kitchenStock->notes = '';
                //     $kitchenStock->createable()->associate($service);
                //     $kitchenStock->save();
                // }


// dd($product->stock->product_id);

                // Save warehouse stock
                $kitchenStock = KitchenStock::where('product_id', $product->stock->product_id)->where('kitchen_id', $this->sale->kitchen_id)->first();
                if ($kitchenStock) {
                    $kitchenStock->quantity        += $product->quantity_available;
                    $kitchenStock->cost            = $product->cost;
                    // $kitchenStock->production_date = $product->production_date;
                    // $kitchenStock->expiration_date = $product->expiration_date;
                    $kitchenStock->save();
                } else {
                    $kitchenStock = new KitchenStock();
                    $kitchenStock->kitchen_id         = $this->sale->kitchen_id;
                    $kitchenStock->product_id         = $product->stock->product_id;
                    $kitchenStock->quantity           = $product->quantity_available;
                    $kitchenStock->cost               = $product->cost;
                    // $kitchenStock->production_date    = $product->production_date;
                    // $kitchenStock->expiration_date    = $product->expiration_date;
                    $kitchenStock->notes              = 'Add';
                    $kitchenStock->createable()->associate($service);
                    $kitchenStock->save();
                }

                // Save Kitchen stock movements
                $kitchenStockMovement = new KitchenStockMovement();
                $kitchenStockMovement->kitchen_stock_id = $kitchenStock->id;
                $kitchenStockMovement->type = 'Add';
                $kitchenStockMovement->date = now();
                $kitchenStockMovement->quantity = $product->quantity_available;
                $kitchenStockMovement->notes = 'Add';
                $kitchenStockMovement->createable()->associate($service);
                $kitchenStockMovement->save();

            }











            $this->reset();

            // Hide modal
            $this->dispatch('shippedSaleModalToggle');
            $this->dispatch('refreshTitleShipped'); 

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
        return view('admin.pages.sales.partials.shipped');
    }
}
