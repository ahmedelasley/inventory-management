<?php

namespace App\Livewire\Admin\Pages\Users\Partials;

use Livewire\Component;
use App\Models\User;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{

    public $user;
    
    public $name;
    public $email;
    public $role;
    public $email_verified_at;

    protected $listeners = ['userShow'];

    public function userShow($id)
    {
        $this->user = User::find($id);
    
        if (!$this->user) {
            // Alert 
            showAlert($this, 'error', 'user not found');
        }
    
        // Set the properties
        $this->name                 = $this->user->name;
        $this->email                = $this->user->email;
        $this->role                 = $this->user->getRoleNames()[0];
        $this->email_verified_at    = $this->user->email_verified_at;

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

        return view('admin.pages.users.partials.show');
    }
}
