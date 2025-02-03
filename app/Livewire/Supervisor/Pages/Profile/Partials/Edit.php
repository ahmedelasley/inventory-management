<?php

namespace App\Livewire\Supervisor\Pages\Profile\Partials;

use Livewire\Component;
use App\Models\Supervisor;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Supervisor\Pages\Profile\GetData;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use LivewireAlert;

    public $supervisor;
    
    public $name;
    public $email;


    protected $listeners = ['profileUpdate'];

    public function profileUpdate($id)
    {
        $this->supervisor = Supervisor::find($id);
    
        if (!$this->supervisor) {
            // Alert 
            showAlert($this, 'error', 'Supervisor not found');
        }
    
        // Set the properties
        $this->name     = $this->supervisor->name;
        $this->email    = $this->supervisor->email;

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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Supervisor::class)->ignore($this->supervisor->id)],
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
            // $validatedData['updated_id'] = Auth::guard('Supervisor')->user()->id;

            // Query Create
            $this->supervisor->update($validatedData);

            // $this->Supervisor->syncRoles();

            // Step 2: Assign Role for Supervisor
            // if(isset($validatedData['role'])) $this->supervisor->assignRole($validatedData['role']);

            
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



        return view('supervisor.pages.profile.partials.edit');
    }
}
