<?php

namespace App\Livewire\Admin\Pages\Supervisors\Partials;

use Livewire\Component;
use App\Models\Supervisor;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use App\Http\Requests\SupervisorRequest;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Supervisors\GetData;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AssignRole extends Component
{
    use LivewireAlert;

    public $supervisor;
    
    public $role;
    public $name;


    protected $listeners = ['supervisorAssignRole'];


    public function supervisorAssignRole($id)
    {
        $this->supervisor = Supervisor::find($id);
    
        if (!$this->supervisor) {
            // Alert 
            showAlert($this, 'error', 'supervisor not found');
        }
    
        // Set the properties
        $this->name                      = $this->supervisor->name;
        $this->role                      = $this->supervisor->getRoleNames()[0];
        
    
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

            $this->supervisor->syncRoles();

            // Step 2: Assign Role for Supervisor
            if(isset($validatedData['role'])) $this->supervisor->assignRole($validatedData['role']);

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
        return view('admin.pages.supervisors.partials.assign-role');
    }
}
