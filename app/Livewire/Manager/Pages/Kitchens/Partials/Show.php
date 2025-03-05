<?php

namespace App\Livewire\Manager\Pages\Kitchens\Partials;

use Livewire\Component;
use App\Models\Kitchen;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{

    public $kitchen;
    
    public $name;
    public $code;
    public $location;
    public $restaurant;
    public $supervisor;

    protected $listeners = ['kitchenShow'];

    public function kitchenShow($id)
    {
        $this->kitchen = Kitchen::find($id);
    
        if (!$this->kitchen) {
            // Alert 
            showAlert($this, 'error', 'Kitchen not found');
        }
    
        // Set the properties
        $this->name            = $this->kitchen->name;
        $this->code            = $this->kitchen->code;
        $this->location        = $this->kitchen->location;
        $this->restaurant      = $this->kitchen->restaurant?->name;
        $this->supervisor      = $this->kitchen->supervisor?->name;
    
     
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

        return view('manager.pages.kitchens.partials.show');
    }
}
