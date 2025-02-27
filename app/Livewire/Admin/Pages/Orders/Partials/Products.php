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

    protected $listeners = [
        'productRefreshComponent' =>'$refresh',
    ];

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

            // dd($order_id, $product_id);
            // Check warehouse stock availability 
            $product = Product::find($product_id);
            $order = Order::find($order_id);
            $warehouse_stock = WarehouseStock::where('product_id', $product_id)->where('warehouse_id', $order->warehouse_id)->firstOrFail();

            // Check if the item is already in the order

            if ($this->order->status == 'Open') {
                if (!OrderItems::where('order_id', $order_id)->where('warehouse_stock_id', $warehouse_stock?->id)->exists()) {
                    // Create new order item
                    OrderItems::create([
                        'order_id' => $order_id,
                        'warehouse_stock_id' => $warehouse_stock->id,
                        'cost' => $warehouse_stock->cost,
                    ]);
                    $this->order->update([
                        'items' => $this->order->items + 1,
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

            // Commit transaction
            DB::commit();
        } catch (Exception $e) {

            // Rollback transaction on error
            DB::rollBack();

            // Alert error
            showAlert($this, 'error', $e->getMessage());
        }

    }





    //How to make refresh component after edit order
    // public function refreshComponent()
    // {
    //     $this->emit('refreshComponent');
    // }


    public function render()
    {

        $products = WarehouseStock::with(['product', 'createable', 'warehouse'])
                            ->whereHas('warehouse', function ($query) { $query->where('warehouse_id', $this->order->warehouse_id); });

        if (in_array($this->field, ['name', 'sku'])) {
            $products = $products->whereHas('product', function ($query) { $query->where($this->field, 'like', '%' . $this->search . '%'); });
        } else {
            $products = $products->where($this->field, 'like', '%' . $this->search . '%');
         }        
         $products = $products->latest()->paginate($this->paginate);


        return view('admin.pages.orders.partials.products', [
            'products' => $products,
        ]);
    }
}
