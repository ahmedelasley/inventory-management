<?php

namespace App\Livewire\Admin\Pages\Sales\Partials;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Menu;
use App\Models\Sale;
use App\Models\SaleItems;
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
    public $sale;

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
        $this->paginate = 12;
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
    

    public function addItem($sale_id, $product_id)
    {
        DB::beginTransaction();
        try {


            // Check warehouse stock availability 
            $product = Menu::find($product_id);
            $sale = Sale::find($sale_id);
            // $warehouse_stock = WarehouseStock::where('product_id', $product_id)->where('warehouse_id', $sale->warehouse_id)->first();

            // dd($warehouse_stock->quantity);
            // Check if the item is already in the sale

            if ($this->sale->status == 'Open') {
                if (!SaleItems::where('sale_id', $sale_id)->where('menu_id', $product->id)->exists()) {
                    // Create new sale item
                    $item = SaleItems::create([
                        'sale_id' => $sale_id,
                        'menu_id' => $product->id,
                        'quantity' => 1,
                        'cost' => $product->price,
                    ]);
                    $this->sale->update([
                        'items' => $this->sale->items + 1,
                        'quantities' => $this->sale->quantities + 1,
                        'subtotal' => $this->sale->subtotal + $item->cost,

                        // 'subtotal' => $this->sale->subtotal - ($this->item->quantity * $this->item->cost ) + ($validatedData['quantity'] * $validatedData['cost'] ) ,
                    ]);
    
                    // Add editor
                    $service = Admin::find(Auth::guard('admin')->user()->id);
                    $this->sale->editor()->associate($service);
                    $this->sale->save();  
                    
                } else {
                    $item = SaleItems::where('sale_id', $sale_id)->where('menu_id', $product->id)->first();
                    $item->update([
                        'quantity' => $item->quantity + 1,
                    ]);

                    $this->sale->update([
                        'quantities' => $this->sale->quantities + 1,
                        'subtotal' => $this->sale->subtotal + $item->cost,

                        // 'subtotal' => $this->sale->subtotal - ($this->item->quantity * $this->item->cost ) + ($validatedData['quantity'] * $validatedData['cost'] ) ,
                    ]);
                    // showAlert($this, 'error', 'Item is already completed');
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





    
    public function render()
    {
        $products = Menu::with(['creator', 'editor', 'category'])
                            ->whereHas('restaurant', function ($query) { $query->where('restaurant_id', $this->sale->restaurant_id); });

        if ($this->field == 'category') {
            $products = $products->whereHas('category', function ($query) { $query->where('name', 'like', '%' . $this->search . '%'); });
         } else {
            $products = $products->where($this->field, 'like', '%' . $this->search . '%');
         }        
         $products = $products->latest()->paginate($this->paginate);

        return view('admin.pages.sales.partials.products', [
            'products' => $products,
        ]);
    }
}
