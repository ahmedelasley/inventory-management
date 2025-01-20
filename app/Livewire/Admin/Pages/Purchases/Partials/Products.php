<?php

namespace App\Livewire\Admin\Pages\Purchases\Partials;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Product;
use App\Models\PurchaseItems;

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
    public $purchase;

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
    

    public function addItem($purchase_id, $product_id)
    {
        DB::beginTransaction();
        try {
            if ($this->purchase->status == 'Pending') {
                if (!PurchaseItems::where('purchase_id', $purchase_id)->where('product_id', $product_id)->exists()) {
 
                    // Create new purchase item
                    PurchaseItems::create([
                        'purchase_id' => $purchase_id,
                        'product_id' => $product_id,
                    ]);
                    $this->purchase->update([
                        'items' => $this->purchase->items + 1,
                        // 'subtotal' => $this->purchase->subtotal - ($this->item->quantity * $this->item->cost ) + ($validatedData['quantity'] * $validatedData['cost'] ) ,
                    ]);
    
                    // Add updater
                    $service = Admin::find(Auth::guard('admin')->user()->id);
                    $this->purchase->updateable()->associate($service);
                    $this->purchase->save();  
                    
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
        $products = Product::with(['category', 'creator', 'updater']);

        if ($this->field == 'category') {
            $products = $products->whereHas('category', function ($query) { $query->where('name', 'like', '%' . $this->search . '%'); });
         } else {
            $products = $products->where($this->field, 'like', '%' . $this->search . '%');
         }        
         $products = $products->latest()->paginate($this->paginate);

        return view('admin.pages.purchases.partials.products', [
            'products' => $products,
        ]);
    }
}
