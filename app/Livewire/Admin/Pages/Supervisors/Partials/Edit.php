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

class Edit extends Component
{
    use LivewireAlert;

    public $supervisor;
    
    public $name;
    public $email;
    public $role;


    protected $listeners = ['supervisorUpdate'];

    public function supervisorUpdate($id)
    {
        $this->supervisor = Supervisor::find($id);
    
        if (!$this->supervisor) {
            // Alert 
            showAlert($this, 'error', 'supervisor not found');
        }
    
        // Set the properties
        $this->name     = $this->supervisor->name;
        $this->email    = $this->supervisor->email;
        $this->role     = $this->supervisor->getRoleNames()[0];

    
    
        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('editModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('editModalToggle');
    }
    
    public function rules()
    {
        return (new SupervisorRequest('PUT', $this->supervisor->id))->rules();
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

            // Add updater
            // $validatedData['updated_id'] = Auth::guard('supervisor')->user()->id;

            // Query Create
            $this->supervisor->update($validatedData);
            $this->supervisor->syncRoles();

            // Step 2: Assign Role for Supervisor
            if(isset($validatedData['role'])) $this->supervisor->assignRole($validatedData['role']);

            $this->reset();

            // Hide modal
            $this->dispatch('editModalToggle');

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
        $roles = Role::where('guard_name', 'supervisor')->get();

        return view('admin.pages.supervisors.partials.edit',[
            'roles' =>$roles,
        ]);
    }
}
