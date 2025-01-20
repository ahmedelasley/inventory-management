<?php

namespace App\Livewire\Admin\Pages\Supervisors\Partials;

use Livewire\Component;
use App\Models\Supervisor;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{

    public $supervisor;
    
    public $name;
    public $email;
    public $role;
    public $email_verified_at;

    protected $listeners = ['supervisorShow'];

    public function supervisorShow($id)
    {
        $this->supervisor = Supervisor::find($id);
    
        if (!$this->supervisor) {
            // Alert 
            showAlert($this, 'error', 'supervisor not found');
        }
    
        // Set the properties
        $this->name                 = $this->supervisor->name;
        $this->email                = $this->supervisor->email;
        $this->role                 = $this->supervisor->getRoleNames()[0];
        $this->email_verified_at    = $this->supervisor->email_verified_at;

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

        return view('admin.pages.supervisors.partials.show');
    }
}
