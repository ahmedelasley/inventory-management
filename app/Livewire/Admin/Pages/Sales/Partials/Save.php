<?php

namespace App\Livewire\Admin\Pages\Sales\Partials;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Menu;
use App\Models\WarehouseStock;
use App\Models\WarehouseStockMovement;
use App\Models\Kitchen;
use App\Models\KitchenStock;
use App\Models\KitchenStockMovement;
use App\Models\Product;





use App\Models\Sale;
use App\Models\SaleStatus;
use App\Models\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Sales\GetData;
use Illuminate\Support\Facades\Auth;

class Save extends Component
{
    use LivewireAlert;

    public $sale;

    public $code;
    public $type;

    public function mount($sale)
    {
        $this->sale = $sale;
    }

    protected $listeners = ['saleSave'];

    public function saleSave($id)
    {
        $this->sale = Sale::find($id);
    
        if (!$this->sale) {
            // Alert 
            showAlert($this, 'error', 'sale not found');
        }
    
        // Set the properties
        $this->code    = $this->sale->code;
        $this->type    = $this->sale->type;

        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('saveSaleModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('saveSaleModalToggle');
    }
    

    public function submit()
    {

        // dd($this->sale, $this->type);  
        DB::beginTransaction();

        try {
            // Add updater
            $service = Admin::find(Auth::guard('admin')->user()->id);
            
            // 1- Update sale
            $this->sale->type   = 'Completed';
            $this->sale->status = 'Closed';
            $this->sale->editor()->associate($service);
            $this->sale->save();

            // 2 - Save sale Status
            $saleStatus = new SaleStatus();
            $saleStatus->sale_id = $this->sale->id;
            $saleStatus->old_status = 'Pending';
            $saleStatus->new_status = 'Completed';
            $saleStatus->date = now();
            $saleStatus->statusable()->associate($service);
            $saleStatus->save();

            // 3 - Handle reduce stock in Kitchen logic
            foreach ($this->sale->products as $product) {
                // 1 - get menu of product
                $menu = Menu::find($product->menu_id);
                $kitchen = Kitchen::find($menu->kitchen_id);

                // 2 - get ingredients of menu
                foreach ($menu->items as $item) {
                    
                    // get stock of item
                    $kitchenStock = KitchenStock::where('product_id', $item->product_id)->where('kitchen_id', $menu->kitchen_id)->first();
                    $getProduct = Product::where('id', $item->product_id)->first();
                    // dd($getProduct);
                    // reduce stock of item
                    $kitchenStock->update([
                        'quantity' => $kitchenStock->quantity - ( ($product->quantity * $item->quantity) / $getProduct->storage_to_intgredient)
                    ]);

                    // Save Kitchen stock movements
                    $kitchenStockMovement = new KitchenStockMovement();
                    $kitchenStockMovement->kitchen_stock_id = $kitchenStock->id;
                    $kitchenStockMovement->type = 'Reduce';
                    $kitchenStockMovement->date = now();
                    $kitchenStockMovement->quantity = ($product->quantity * $item->quantity) / $getProduct->storage_to_intgredient ;
                    $kitchenStockMovement->notes = 'Reduce';;
                    $kitchenStockMovement->createable()->associate($service);
                    $kitchenStockMovement->save();



                }
                // 3 - get kitchen 

                // 4 - get item of kitchen

                // 5 - get stock of item

                // 6 - reduce stock of item


            }

            
            //get warehouse 
            // $warehouse = Warehouse::find($this->sale->warehouse_id );
            // $kitchen = Kitchen::find($this->sale->kitchen_id );


            // Handle return logic
//             foreach ($this->sale->products as $product) {

//                 $warehouseStock = WarehouseStock::where('id', $product->warehouse_stock_id)->where('warehouse_id', $this->sale->warehouse_id)->first();
//                 if ($warehouseStock) {
//                     $warehouseStock->quantity -= $product->quantity_available;
//                     $warehouseStock->save();
//                 }

//                 // Save warehouse stock movements
//                 $warehouseStockMovement = new WarehouseStockMovement();
//                 $warehouseStockMovement->warehouse_stock_id = $warehouseStock->id;
//                 $warehouseStockMovement->type = 'Reduce';
//                 $warehouseStockMovement->date = now();
//                 $warehouseStockMovement->quantity = $product->quantity_available;
//                 $warehouseStockMovement->notes = 'Reduce';
//                 $warehouseStockMovement->createable()->associate($service);
//                 $warehouseStockMovement->save();




//                 // $kitchenStock = KitchenStock::where('product_id', $product->product_id)->where('kitchen_id', $this->sale->kitchen_id)->first();
//                 // if ($kitchenStock) {
//                 //     $kitchenStock->quantity += $product->quantity_available;
//                 //     $kitchenStock->save();
//                 // } else {
//                 //     $kitchenStock = new KitchenStock();
//                 //     $kitchenStock->kitchen_id = $kitchen->id;
//                 //     $kitchenStock->product_id = $product->product_id;
//                 //     $kitchenStock->quantity = $product->quantity_available;
//                 //     $kitchenStock->notes = '';
//                 //     $kitchenStock->createable()->associate($service);
//                 //     $kitchenStock->save();
//                 // }


// // dd($product->stock->product_id);

//                 // Save warehouse stock
//                 $kitchenStock = KitchenStock::where('product_id', $product->stock->product_id)->where('kitchen_id', $this->sale->kitchen_id)->first();
//                 if ($kitchenStock) {
//                     $kitchenStock->quantity        += $product->quantity_available;
//                     $kitchenStock->cost            = $product->cost;
//                     // $kitchenStock->production_date = $product->production_date;
//                     // $kitchenStock->expiration_date = $product->expiration_date;
//                     $kitchenStock->save();
//                 } else {
//                     $kitchenStock = new KitchenStock();
//                     $kitchenStock->kitchen_id         = $this->sale->kitchen_id;
//                     $kitchenStock->product_id         = $product->stock->product_id;
//                     $kitchenStock->quantity           = $product->quantity_available;
//                     $kitchenStock->cost               = $product->cost;
//                     // $kitchenStock->production_date    = $product->production_date;
//                     // $kitchenStock->expiration_date    = $product->expiration_date;
//                     $kitchenStock->notes              = 'Add';
//                     $kitchenStock->createable()->associate($service);
//                     $kitchenStock->save();
//                 }

//                 // Save Kitchen stock movements
//                 $kitchenStockMovement = new KitchenStockMovement();
//                 $kitchenStockMovement->kitchen_stock_id = $kitchenStock->id;
//                 $kitchenStockMovement->type = 'Add';
//                 $kitchenStockMovement->date = now();
//                 $kitchenStockMovement->quantity = $product->quantity_available;
//                 $kitchenStockMovement->notes = 'Add';
//                 $kitchenStockMovement->createable()->associate($service);
//                 $kitchenStockMovement->save();

//             }











            $this->reset();

            // Hide modal
            $this->dispatch('saveSaleModalToggle');
            $this->dispatch('refreshTitleSave'); 

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
        return view('admin.pages.sales.partials.save');
    }
}
