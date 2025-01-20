<?php

namespace App\Livewire\Admin\Pages\Users\Partials;

use Livewire\Component;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Users\GetData;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AssignRole extends Component
{
    use LivewireAlert;

    public $user;
    
    public $role;
    public $name;


    protected $listeners = ['userAssignRole'];

    public function userAssignRole($id)
    {
        $this->user = User::find($id);
    
        if (!$this->user) {
            // Alert 
            showAlert($this, 'error', 'user not found');
        }
    
        // Set the properties
        $this->name                      = $this->user->name;
        $this->role                      = $this->user->getRoleNames()[0];
        
    
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

            $this->user->syncRoles();

            // Step 2: Assign Role for user
            if(isset($validatedData['role'])) $this->user->assignRole($validatedData['role']);

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
        $roles = Role::where('guard_name', 'web')->get();

        return view('admin.pages.users.partials.assign-role', [
            'roles' => $roles,
        ]);
    }
}
