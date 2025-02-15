<?php

namespace App\Livewire\Admin\Pages\Managers\Partials;

use Livewire\Component;
use App\Models\Manager;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{

    public $manager;
    
    public $name;
    public $email;
    public $role;
    public $email_verified_at;

    protected $listeners = ['managerShow'];

    public function managerShow($id)
    {
        $this->manager = Manager::find($id);
    
        if (!$this->manager) {
            // Alert 
            showAlert($this, 'error', 'manager not found');
        }
    
        // Set the properties
        $this->name                 = $this->manager->name;
        $this->email                = $this->manager->email;
        $this->role                 = $this->manager->getRoleNames()[0];
        $this->email_verified_at    = $this->manager->email_verified_at;

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

        return view('admin.pages.managers.partials.show');
    }
}
