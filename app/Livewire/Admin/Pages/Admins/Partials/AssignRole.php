<?php

namespace App\Livewire\Admin\Pages\Admins\Partials;

use Livewire\Component;
use App\Models\Admin;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use App\Http\Requests\AdminRequest;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Admins\GetData;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AssignRole extends Component
{
    use LivewireAlert;

    public $admin;
    
    public $role;
    public $name;


    protected $listeners = ['adminAssignRole'];

    public function adminAssignRole($id)
    {
        $this->admin = Admin::find($id);
    
        if (!$this->admin) {
            // Alert 
            showAlert($this, 'error', 'admin not found');
        }
    
        // Set the properties
        $this->name                      = $this->admin->name;
        $this->role                      = $this->admin->getRoleNames()[0];
        
    
        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('assignRoleModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('assignRoleModalToggle');
    }
    
    public function rules()
    {
        return [
            'role' => 'required|string|exists:roles,name',
        ];
    } 
 
    public function updated($field)
    {
        $this->validateOnly($field);
    }



    public function submit()
    {
        DB::beginTransaction();

        try {
            // Check of Validation
            $validatedData       = $this->validate();


            // Query Create

            $this->admin->syncRoles();

            // Step 2: Assign Role for Admin
            if(isset($validatedData['role'])) $this->admin->assignRole($validatedData['role']);

            // Hide modal
            $this->dispatch('assignRoleModalToggle');

            // Refresh skills data component
            $this->dispatch('refreshData')->to(GetData::class);
            
            // Alert 
            showAlert($this, 'success', __('Done Added Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction            
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        }
    }


    public function render()
    {
        $roles = Role::where('guard_name', 'admin')->get();

        return view('admin.pages.admins.partials.assign-role', [
            'roles' => $roles,
        ]);
    }
}
