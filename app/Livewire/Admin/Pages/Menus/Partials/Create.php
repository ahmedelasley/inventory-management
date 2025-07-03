<?php

namespace App\Livewire\Admin\Pages\Menus\Partials;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Kitchen;
use App\Models\Menu;
use App\Livewire\Admin\Pages\Menus\GetData;
use App\Http\Requests\MenuRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use LivewireAlert;
    // protected $listeners = ['refreshForm' => '$refresh'];

    // public $name, $description, $parent_id; 

    public $categories;
    public $restaurants;
    public $kitchens = []; // لتخزين المطابخ بناءً على المطعم المحدد

    public $name;
    public $name_localized;
    public $sku;
    public $description;
    public $price;

    public $category_id;
    public $restaurant_id;
    public $kitchen_id;

    public function mount()
    {
        $this->categories = Category::with(['parent', 'children'])->where('type', 1)->get() ?? collect(); // تجنب null
        $this->restaurants = Restaurant::all() ?? collect(); // تجنب null
        $this->kitchens = collect(); // دائماً قائمة فارغة في البداية
    }

    // عند تغيير المطعم، يتم تحديث قائمة المطابخ تلقائيًا
    public function updatedRestaurantId($value)
    {
        $this->kitchens = Kitchen::where('restaurant_id', $value)->get() ?? collect();
        $this->kitchen_id = null; // إعادة التعيين
    }


    protected function rules(): array 
    {
        return (new MenuRequest())->rules();
    } 
 
    public function updated($field)
    {
        $this->validateOnly($field);
    }

    
    public function submit()
    {
        DB::beginTransaction();

        try {
            // dd($this->validate());

            // Check of Validation
            $validatedData       = $this->validate();
            // Add creator
            $validatedData['sku'] = 'M-' . (Menu::count() == 0 ? '1001' : (int) str_replace('M-', '', Menu::latest()->first()->sku) + 1 );
            // $validatedData['created_id'] = Auth::guard('admin')->user()->id;

            // Query Create
            // Menu::create($validatedData);

                   // Associate the purchase with the admin user
        $service = Admin::find(Auth::guard('admin')->user()->id);
        // Create the purchase record
        $menu = new Menu($validatedData);
        if ($service) {
            $menu->creator()->associate($service);
        }
        $menu->save();


            $this->reset();

            // Hide modal
            $this->dispatch('close-modal');

            // Refresh skills data component
            $this->dispatch('refreshData')->to(GetData::class);
            // $this->dispatch('refreshForm')->to(Create::class);
            
            // Alert 
            showAlert($this, 'success', __('Done Added Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction            
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        }
    }

    public function closeForm()
    {
        //Reset 
        $this->reset(); // Clear attributes
        $this->resetValidation();   // Clear Validation
        $this->resetErrorBag(); // Clear errors

        $this->dispatch('close-modal'); // Trigger modal close via JS
    }
    public function resetForm()
    {
        //Reset 
        $this->reset(); // Clear attributes
        $this->resetValidation();   // Clear Validation
        $this->resetErrorBag(); // Clear errors

        // $this->dispatch('close-modal'); // Trigger modal close via JS
    }
    public function render()
    {
        // $data = Category::with(['parent', 'children'])->get();
        // $restaurants = Restaurant::get();
        // $kitchens = Kitchen::get();

        return view('admin.pages.menus.partials.create', [
            // 'data' => $data,
            // 'restaurants' => $restaurants,
            // 'kitchens' => $kitchens,
        ]);
    }
}
