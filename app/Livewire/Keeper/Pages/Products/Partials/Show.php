<?php

namespace App\Livewire\Keeper\Pages\Products\Partials;

use Livewire\Component;
use App\Models\Product;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{

    public $product;
    
    public $name;
    public $name_localized;
    public $sku;
    public $description;
    public $storge_unit;
    public $intgredtiant_unit;
    public $storage_to_intgredient;
    public $costing_method;
    public $category;

    protected $listeners = ['productShow'];

    public function productShow($id)
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
        $this->category               = $this->product->category?->name;
    
     
        // Open modal
        $this->dispatch('showModalToggle');
    }

    public function closeForm()
    {   
        // Close modal
        $this->dispatch('showModalToggle');
    }
    
    public function render()
    {

        return view('keeper.pages.products.partials.show');
    }
}
