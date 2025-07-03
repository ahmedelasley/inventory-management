<?php

namespace App\Livewire\Manager\Pages\Menus\Partials;

use Livewire\Component;
use App\Models\Manager;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Kitchen;
use App\Models\Menu;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use App\Http\Requests\MenuRequest;

use Illuminate\Support\Facades\DB;
use App\Livewire\Manager\Pages\Menus\GetData;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use LivewireAlert;

    public $menu;

    public $categories;
    public $restaurants;
    public $kitchens = [];

    public $category_id;
    public $restaurant_id;
    public $kitchen_id;
    
    public $name;
    public $description;
    public $name_localized;
    public $description_localized;
    public $price;
    public $tax;
    public $barcode;
    public $calories;
    public $preparation_time;
    public $walking_minutes_to_burn_calories;
    public $is_high_salt;


    public function mount()
    {
        $this->categories = Category::with(['parent', 'children'])->where('type', 1)->get() ?? collect(); // تجنب null
        $this->restaurants = Restaurant::all() ?? collect(); // تجنب null
        $this->kitchens = Kitchen::all() ?? collect(); // دائماً قائمة فارغة في البداية
    }

    // عند تغيير المطعم، يتم تحديث قائمة المطابخ تلقائيًا
    public function updatedRestaurantId($value)
    {
        $this->kitchens = Kitchen::where('restaurant_id', $value)->get() ?? collect();
        $this->kitchen_id = null; // إعادة التعيين
    }



    // protected $listeners = ['menuUpdate'];
    protected $listeners = [
        'menuUpdate' => 'menuUpdate', // Listener for the 'menuUpdate' event
    ];
    public function menuUpdate($id)
    {
        $this->menu = Menu::find($id);
    
        if (!$this->menu) {
            // Alert 
            showAlert($this, 'error', 'menu not found');
        }
    
        // Set the properties
        $this->name                             = $this->menu->name;
        $this->description                      = $this->menu->description;
        $this->name_localized                   = $this->menu->name_localized;
        $this->description_localized            = $this->menu->description_localized;
        $this->price                            = $this->menu->price;
        $this->tax                              = $this->menu->tax;
        $this->barcode                          = $this->menu->barcode;
        $this->calories                         = $this->menu->calories;
        $this->preparation_time                 = $this->menu->preparation_time;
        $this->walking_minutes_to_burn_calories = $this->menu->walking_minutes_to_burn_calories;
        $this->is_high_salt                     = $this->menu->is_high_salt;
        $this->category_id                      = $this->menu->category_id;
        $this->restaurant_id                    = $this->menu->restaurant_id;
        $this->kitchen_id                       = $this->menu->kitchen_id;

    
        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('editModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('editModalToggle');
    }
    
    public function rules()
    {
        // return (new MenuRequest('PUT', $this->menu->id))->rules();
        return [
            'restaurant_id' => 'required|exists:restaurants,id',
            'kitchen_id' => 'required|exists:kitchens,id',
            'name' => ['required', 'string', 'max:255' , Rule::unique('menus')->ignore($this->menu?->id)] ,
            'name_localized' => 'nullable|string|min:3|max:255',
            'description' => 'nullable|string|min:3|max:255',
            'description_localized' => 'nullable|string|min:3|max:255',
            'price' => 'required|numeric|decimal:0,4|gt:0',
            'category_id' => 'required|exists:categories,id',

            'tax' => 'required|string',
            'barcode' => 'required|string',

            'calories' => 'nullable|string',
            'preparation_time' => 'nullable|string',
            'walking_minutes_to_burn_calories' => 'nullable|string',

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

            $this->menu->update($validatedData);

            // Add updater
            $service = Manager::find(Auth::guard('manager')->user()->id);
            $this->menu->editor()->associate($service);
            $this->menu->save(); 

            $this->reset();

            // Hide modal
            $this->dispatch('editModalToggle');

            // Refresh skills data component
            $this->dispatch('refreshEdit');

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
        // $data = Category::with(['parent', 'children'])->paginate(20);

        return view('manager.pages.menus.partials.edit', [
            // 'data' => $data,
        ]);
    }
}
