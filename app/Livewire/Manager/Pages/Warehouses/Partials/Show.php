<?php

namespace App\Livewire\Manager\Pages\Warehouses\Partials;

use Livewire\Component;
use App\Models\Warehouse;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{

    public $warehouse;
    
    public $name;
    public $code;
    public $location;
    public $restaurant;
    public $keeper;

    protected $listeners = ['warehouseShow'];

    public function warehouseShow($id)
    {
        $this->warehouse = Warehouse::find($id);
    
        if (!$this->warehouse) {
            // Alert 
            showAlert($this, 'error', 'Warehouse not found');
        }
    
        // Set the properties
        $this->name            = $this->warehouse->name;
        $this->code            = $this->warehouse->code;
        $this->location        = $this->warehouse->location;
        $this->restaurant      = $this->warehouse->restaurant?->name;
        $this->keeper          = $this->warehouse->keeper?->name;
    
     
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

        return view('manager.pages.warehouses.partials.show');
    }
}
