<?php

namespace App\Livewire\Admin\Pages\Keepers\Partials;

use Livewire\Component;
use App\Models\Keeper;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{

    public $keeper;
    
    public $name;
    public $email;
    public $role;
    public $email_verified_at;

    protected $listeners = ['keeperShow'];

    public function keeperShow($id)
    {
        $this->keeper = Keeper::find($id);
    
        if (!$this->keeper) {
            // Alert 
            showAlert($this, 'error', 'keeper not found');
        }
    
        // Set the properties
        $this->name                 = $this->keeper->name;
        $this->email                = $this->keeper->email;
        $this->role                 = $this->keeper->getRoleNames()[0];
        $this->email_verified_at    = $this->keeper->email_verified_at;

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

        return view('admin.pages.keepers.partials.show');
    }
}
