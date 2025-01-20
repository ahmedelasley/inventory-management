<?php

namespace App\Livewire\Admin\Pages\Roles\Supervisors\Partials;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Roles\Supervisors\GetData;

class Show extends Component
{

    public $role;
    public $name;
    public $permissions = [];

    protected $listeners = ['roleShow'];

    public function roleShow($id)
    {
        $this->role = Role::find($id);
    
        if (!$this->role) {
            // Alert 
            showAlert($this, 'error', 'role not found');
        }
    
        // Set the properties
        $this->name = $this->role->name;
        $this->permissions = $this->role->permissions->pluck('id')->toArray();    

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
        $groups = Permission::where('guard_name', 'supervisor')->get();

        return view('admin.pages.roles.supervisors.partials.show', [
            'groups' => $groups,
        ]);
    }
}
