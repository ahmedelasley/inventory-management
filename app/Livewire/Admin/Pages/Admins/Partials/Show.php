<?php

namespace App\Livewire\Admin\Pages\Admins\Partials;

use Livewire\Component;
use App\Models\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{

    public $admin;
    
    public $name;
    public $email;
    public $role;
    public $email_verified_at;

    protected $listeners = ['adminShow'];

    public function adminShow($id)
    {
        $this->admin = Admin::find($id);
    
        if (!$this->admin) {
            // Alert 
            showAlert($this, 'error', 'admin not found');
        }
    
        // Set the properties
        $this->name                 = $this->admin->name;
        $this->email                = $this->admin->email;
        $this->role                 = $this->admin->getRoleNames()[0];
        $this->email_verified_at    = $this->admin->email_verified_at;

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

        return view('admin.pages.admins.partials.show');
    }
}
