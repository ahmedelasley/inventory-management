<?php

namespace App\Livewire\Manager\Pages\Products\Partials;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use App\Http\Requests\ProductRequest;

use Illuminate\Support\Facades\DB;
use App\Livewire\Manager\Pages\Products\GetData;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use LivewireAlert;

    public $product;
    
    public $name;
    public $name_localized;
    public $sku;
    public $description;
    public $storge_unit;
    public $intgredtiant_unit;
    public $storage_to_intgredient;
    public $costing_method;
    public $category_id;

    protected $listeners = ['productUpdate'];

    public function productUpdate($id)
    {
        $this->product = Product::find($id);
    
        if (!$this->product) {
            // Alert 
            showAlert($this, 'error', 'product not found');
        }
    
        // Set the properties
        $this->name                      = $this->product->name;
        $this->name_localized            = $this->product->name_localized;
        $this->sku                       = $this->product->sku;
        $this->description               = $this->product->description;
        $this->storge_unit               = $this->product->storge_unit;
        $this->intgredtiant_unit         = $this->product->intgredtiant_unit;
        $this->storage_to_intgredient    = $this->product->storage_to_intgredient;
        $this->costing_method            = $this->product->costing_method;
        $this->category_id               = $this->product->category_id;
    
    
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
        return (new ProductRequest('PUT', $this->product->id))->rules();
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

            // Add updater
            $validatedData['updated_id'] = Auth::guard('manager')->user()->id;

            // Query Create
            $this->product->update($validatedData);

            $this->reset();

            // Hide modal
            $this->dispatch('editModalToggle');

            // Refresh skills data component
            $this->dispatch('refreshData')->to(GetData::class);
            
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
        $data = Category::with(['parent', 'children'])->where('type', 0)->paginate(20);

        return view('manager.pages.products.partials.edit', [
            'data' => $data,
        ]);
    }
}
