<?php

namespace App\Livewire\Manager\Pages\Restaurants\Partials;

use Livewire\Component;
use App\Models\Restaurant;
use App\Models\User;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{

    public $restaurant;
    
    public $name;
    public $code;
    public $location;
    public $manager;

    protected $listeners = ['restaurantShow'];

    public function restaurantShow($id)
    {
        $this->restaurant = Restaurant::find($id);
    
        if (!$this->restaurant) {
            // Alert 
            showAlert($this, 'error', 'Restaurant not found');
        }
    
        // Set the properties
        $this->name            = $this->restaurant->name;
        $this->code            = $this->restaurant->code;
        $this->location        = $this->restaurant->location;
        $this->manager         = $this->restaurant->manager?->name;
    
     
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

        return view('manager.pages.restaurants.partials.show');
    }
}
