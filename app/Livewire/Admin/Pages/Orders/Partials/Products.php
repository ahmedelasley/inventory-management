<?php

namespace App\Livewire\Admin\Pages\Orders\Partials;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\WarehouseStock;

use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Products extends Component
{
    use LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $field = 'name';
    public $paginate;
    public $order;

    // public float $quantity;
    // public float $cost;
    // public $production_date;
    // public $expiration_date;
    // public $notes;

    protected function queryString()
    {
        return [
            'search' => [
                'except' => '',
                'as' => 'q',
            ],
            'paginate' => [
                'except' => 1,
            ],
        ];
    }

    public function mount()
    {
        $this->paginate = 24;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingPaginate()
    {
        $this->resetPage();
    }

    public function searchField($searchField)
    {
        $this->field = $searchField;
    }
    

    public function addItem($order_id, $product_id)
    {
        DB::beginTransaction();
        try {


            // Check warehouse stock availability 
            $product = Product::find($product_id);
            $order = Order::find($order_id);
            $warehouse_stock = WarehouseStock::where('product_id', $product_id)->where('warehouse_id', $order->warehouse_id)->first();

            // dd($warehouse_stock->quantity);
            // Check if the item is already in the order

            if ($this->order->status == 'Open') {
                if (!OrderItems::where('order_id', $order_id)->where('warehouse_stock_id', $warehouse_stock->id)->exists()) {
                    // Create new order item
                    OrderItems::create([
                        'order_id' => $order_id,
                        'warehouse_stock_id' => $warehouse_stock->id,
                        // 'quantity_available' => $warehouse_stock->quantity,
                    ]);
                    $this->order->update([
                        'items' => $this->order->items + 1,
                        // 'subtotal' => $this->order->subtotal - ($this->item->quantity * $this->item->cost ) + ($validatedData['quantity'] * $validatedData['cost'] ) ,
                    ]);
    
                    // Add updater
                    $service = Admin::find(Auth::guard('admin')->user()->id);
                    $this->order->updateable()->associate($service);
                    $this->order->save();  
                    
                } else {
                    showAlert($this, 'error', 'Item is already completed');
                }

            }
            

          
            $this->dispatch('addItem');
            // $this->dispatch('addItem')->to(Cart::class);
            // $this->dispatch('addItem')->self();

            // Commit transaction
            DB::commit();
        } catch (Exception $e) {

            // Rollback transaction on error
            DB::rollBack();

            // Alert error
            showAlert($this, 'error', $e->getMessage());
        }

    }





    
    public function render()
    {
        $products = Product::with(['category', 'creator', 'updater', 'warehouseStocks'])
                            ->whereHas('warehouseStocks');


        if ($this->field == 'category') {
            $products = $products->whereHas('category', function ($query) { $query->where('name', 'like', '%' . $this->search . '%'); });
         } else {
            $products = $products->where($this->field, 'like', '%' . $this->search . '%');
         }        
         $products = $products->latest()->paginate($this->paginate);

        return view('admin.pages.orders.partials.products', [
            'products' => $products,
        ]);
    }
}
