<?php

namespace App\Livewire\Admin\Pages\Categories\Partials;

use Livewire\Component;
use App\Models\Category;

class Show extends Component
{

    public $category;
    
    public $name;
    public $description;
    public $parent; 
    
    protected $listeners = ['categoryShow'];

    public function categoryShow($id)
    {
        $this->category = Category::find($id);
    
        if (!$this->category) {
            // Alert 
            showAlert($this, 'error', 'Client not found');
        }
    
        // Set the properties
        $this->name         = $this->category->name;
        $this->description  = $this->category->description;
        $this->parent       = $this->category->parent?->name;

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

        return view('admin.pages.categories.partials.show');
    }
}
