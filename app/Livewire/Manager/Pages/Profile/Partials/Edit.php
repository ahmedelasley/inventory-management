<?php

namespace App\Livewire\Manager\Pages\Profile\Partials;

use Livewire\Component;
use App\Models\Manager;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use App\Http\Requests\managerRequest;

use Illuminate\Support\Facades\DB;
use App\Livewire\Manager\Pages\Profile\GetData;
use Illuminate\Support\Facades\Auth;
// use Spatie\Permission\Models\Role;

class Edit extends Component
{
    use LivewireAlert;

    public $manager;
    
    public $name;
    public $email;


    protected $listeners = ['profileUpdate'];

    public function profileUpdate($id)
    {
        $this->manager = Manager::find($id);
    
        if (!$this->manager) {
            // Alert 
            showAlert($this, 'error', 'manager not found');
        }
    
        // Set the properties
        $this->name     = $this->manager->name;
        $this->email    = $this->manager->email;

        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('editProfileModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('editProfileModalToggle');
    }
  
    
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Manager::class)->ignore($this->manager->id)],
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

            // Add updater
            // $validatedData['updated_id'] = Auth::guard('manager')->user()->id;

            // Query Create
            $this->manager->update($validatedData);

            // $this->manager->syncRoles();

            // Step 2: Assign Role for manager
            // if(isset($validatedData['role'])) $this->manager->assignRole($validatedData['role']);

            
            $this->reset();

            // Hide modal
            $this->dispatch('editProfileModalToggle');

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



        return view('manager.pages.profile.partials.edit');
    }
}
