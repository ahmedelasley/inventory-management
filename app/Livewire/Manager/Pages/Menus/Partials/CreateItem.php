<?php

namespace App\Livewire\Manager\Pages\Menus\Partials;

use Livewire\Component;
use App\Models\Manager;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItems;
use App\Models\KitchenStock;
use App\Models\Product;
use App\Livewire\Manager\Pages\Menus\GetShow;
use App\Http\Requests\MenuRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class CreateItem extends Component
{
    use LivewireAlert;
    public $menu;
    public $product_id;
    public $quantity;
    public $cost;

    
    protected $listeners = ['addItem'];

    public function addItem($id)
    {

        $this->menu = Menu::find($id);

        if (!$this->menu) {
            // Alert 
            showAlert($this, 'error', 'menu not found');
        }
        // $this->product_id  = $this->menu->id
       
        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('createItemModalToggle');
    }

    public function closeForm()
    {
        //Reset 
        $this->reset(); // Clear attributes
        $this->resetValidation();   // Clear Validation
        $this->resetErrorBag(); // Clear errors

        $this->dispatch('createItemModalToggle'); // Trigger modal close via JS
    }
    public function resetForm()
    {
        //Reset 
        $this->reset(); // Clear attributes
        $this->resetValidation();   // Clear Validation
        $this->resetErrorBag(); // Clear errors

        $this->dispatch('createItemModalToggle'); // Trigger modal close via JS
    }

    
    protected function rules(): array 
    {
        return [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|decimal:0,4|gt:0',
        ];
    } 
 
    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function submit()
    {
        DB::beginTransaction();

        try {

            // Check of Validation
            $validatedData       = $this->validate();
            $restaurantId = $this->menu?->restaurant_id;

            $product = Product::where('id', $validatedData['product_id'])->first(); // احضار أول عنصر مطابق فقط

            $item = KitchenStock::whereHas('kitchen', function ($query) use ($restaurantId) {
                    $query->where('restaurant_id', $restaurantId);
                })
                ->where('product_id', $validatedData['product_id'])
                ->first(); // احضار أول عنصر مطابق فقط
            
            // dd($item); // استخدم `?->` لتجنب الأخطاء إذا كان `null`



            $validatedData['menu_id'] = $this->menu?->id;
            $validatedData['cost'] = $item?->cost;
            $validatedData['total'] = $item?->cost * $validatedData['quantity'];
            $validatedData['unit'] = $product?->intgredtiant_unit;

            // Query Create
            // Associate the purchase with the manager user
            $service = Manager::find(Auth::guard('manager')->user()->id);

            // Create the purchase record
            $menuItem = new MenuItems($validatedData);
            $menuItem->menu_id = $this->menu?->id;
            $menuItem->cost = ($item?->cost / $product?->storage_to_intgredient);
            $menuItem->total = ($item?->cost / $product?->storage_to_intgredient) * $validatedData['quantity'];
            $menuItem->unit = $product?->intgredtiant_unit;
            if ($service) {
                $menuItem->creator()->associate($service);
            }
            $menuItem->save();


            $this->reset();

            // Hide modal
            $this->dispatch('createItemModalToggle');

            // Refresh skills data component
            $this->dispatch('refreshAddItem');
            
            // Alert 
            showAlert($this, 'success', __('Done Added Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction            
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        }
    }


    public function render()
    {
        // $menuId = $this->menu?->id; // رقم المطعم المطلوب
        // $restaurantId = $this->menu?->restaurant_id; // رقم المطعم المطلوب
        // $kitchenId = $this->menu?->kitchen_id; // رقم المطبخ المطلوب

        // $items = KitchenStock::whereHas('kitchen', function ($query) use ($restaurantId) {
        //     $query->where('restaurant_id', $restaurantId);
        // })->with('product')->get()->unique('product_id');

        // $items = Product::whereHas('kitchenStocks.kitchen', function ($query) use ($restaurantId, $kitchenId) {
        //     $query->where('restaurant_id', $restaurantId)->where('id', $kitchenId);
        // })
        // ->whereHas('menuItems', function ($query) use ($menuId) {
        //     $query->where('menu_id', $menuId);
        // })
        // ->distinct()
        // ->get();

        // $items = Product::whereHas('kitchen_stocks.kitchen', function ($query) use ($restaurantId) {
        //     $query->where('restaurant_id', $restaurantId);
        // })
        // ->distinct()
        // ->get();





        $menuId = $this->menu?->id; // رقم القائمة المطلوبة
$restaurantId = $this->menu?->restaurant_id; // رقم المطعم المطلوب
$kitchenId = $this->menu?->kitchen_id; // رقم المطبخ المطلوب

$items = Product::whereHas('kitchenStocks', function ($query) use ($restaurantId, $kitchenId) {
        $query->whereHas('kitchen', function ($query) use ($restaurantId, $kitchenId) {
            $query->where('restaurant_id', $restaurantId)
                  ->where('id', $kitchenId);
        });
    })
    ->whereDoesntHave('menuItems', function ($query) use ($menuId) {
        $query->where('menu_id', $menuId);
    })
    ->distinct()
    ->get();

        return view('manager.pages.menus.partials.create-item',[
            'items' => $items,
        ]);
    }
}
