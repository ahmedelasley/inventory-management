<?php

namespace App\Livewire\Admin\Pages\Supervisors\Partials;

use Livewire\Component;
use App\Models\Supervisor;
use App\Livewire\Admin\Pages\Supervisors\GetData;
use App\Http\Requests\SupervisorRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use LivewireAlert;

    public $name, $email, $role;

    protected function rules(): array 
    {
        return (new SupervisorRequest())->rules();
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

            // Add Data
            $validatedData['password'] = bcrypt('password');
            $validatedData['created_id'] = Auth::guard('admin')->user()->id;

            // Query Create
            $supervisor =Supervisor::create($validatedData);
            // Step 2: Assign Role for Supervisor
            if(isset($validatedData['role'])) $supervisor->assignRole($validatedData['role']);
            
            // Hide modal
            $this->closeForm();

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
 
    public function closeForm()
    {
        //Reset 
        $this->reset(); // Clear attributes
        $this->resetValidation();   // Clear Validation
        $this->resetErrorBag(); // Clear errors

        $this->dispatch('close-modal'); // Trigger modal close via JS
    }

    public function render()
    {
        $roles = Role::where('guard_name', 'supervisor')->get();

        return view('admin.pages.supervisors.partials.create',[
            'roles' =>$roles,
        ]);
    }
}
