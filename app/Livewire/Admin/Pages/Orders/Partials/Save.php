<?php

namespace App\Livewire\Admin\Pages\Orders\Partials;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use App\Models\WarehouseStockMovement;
use App\Models\Kitchen;
use App\Models\KitchenStock;
use App\Models\KitchenStockMovement;





use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Orders\GetData;
use Illuminate\Support\Facades\Auth;

class Save extends Component
{
    use LivewireAlert;

    public $order;

    public $code;
    public $type;

    public function mount($order)
    {
        $this->order = $order;
    }

    protected $listeners = ['orderSave'];

    public function orderSave($id)
    {
        $this->order = Order::find($id);
    
        if (!$this->order) {
            // Alert 
            showAlert($this, 'error', 'Order not found');
        }
    
        // Set the properties
        $this->code    = $this->order->code;
        $this->type    = $this->order->type;

        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('saveOrderModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('saveOrderModalToggle');
    }
    

    public function submit()
    {

        // dd($this->order, $this->type);  
        DB::beginTransaction();

        try {
            // Add updater
            $service = Admin::find(Auth::guard('admin')->user()->id);
            
            // Save Order Status
            $orderStatus = new OrderStatus();
            $orderStatus->order_id = $this->order->id;
            $orderStatus->old_status = $this->order->type;
            $orderStatus->new_status = 'Received';
            $orderStatus->date = now();
            $orderStatus->statusable()->associate($service);
            $orderStatus->save();

            // 1- Update order
            $this->order->type   = 'Received';
            $this->order->status = 'Closed';

            $this->order->updateable()->associate($service);
            $this->order->save();

            
            //get warehouse 
            $warehouse = Warehouse::find($this->order->warehouse_id );
            $kitchen = Kitchen::find($this->order->kitchen_id );


            // Handle return logic
            foreach ($this->order->products as $product) {

                $warehouseStock = WarehouseStock::where('id', $product->warehouse_stock_id)->where('warehouse_id', $this->order->warehouse_id)->first();
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




                // $kitchenStock = KitchenStock::where('product_id', $product->product_id)->where('kitchen_id', $this->order->kitchen_id)->first();
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
                $kitchenStock = KitchenStock::where('product_id', $product->stock->product_id)->where('kitchen_id', $this->order->kitchen_id)->first();
                if ($kitchenStock) {
                    $kitchenStock->quantity        += $product->quantity_available;
                    $kitchenStock->cost            = $product->cost;
                    // $kitchenStock->production_date = $product->production_date;
                    // $kitchenStock->expiration_date = $product->expiration_date;
                    $kitchenStock->save();
                } else {
                    $kitchenStock = new KitchenStock();
                    $kitchenStock->kitchen_id         = $this->order->kitchen_id;
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
            $this->dispatch('saveOrderModalToggle');
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
        return view('admin.pages.orders.partials.save');
    }
}
