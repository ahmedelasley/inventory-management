<?php

namespace App\Livewire\Admin\Pages\Products\Partials;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Livewire\Admin\Pages\Products\GetData;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use LivewireAlert;
    // protected $listeners = ['refreshForm' => '$refresh'];

    // public $name, $description, $parent_id; 
    public $name;
    public $name_localized;
    public $sku;
    public $description;
    public $storge_unit;
    public $intgredtiant_unit;
    public $storage_to_intgredient;
    public $costing_method;
    public $category_id;


    protected function rules(): array 
    {
        return (new ProductRequest())->rules();
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
            $validatedData['sku'] = 'sku-' . (Product::count() == 0 ? '0001' : (int) str_replace('sku-', '', Product::latest()->first()->sku) + 1 );
            // $validatedData['created_id'] = Auth::guard('admin')->user()->id;

            // Query Create
            Product::create($validatedData);

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
        $data = Category::with(['parent', 'children'])->where('type', 0)->paginate(20);
        return view('admin.pages.products.partials.create', [
            'data' => $data,
        ]);
    }
}
