<?php

namespace App\Livewire\Admin\Pages\Profile\Partials;

use Livewire\Component;
use App\Models\Admin;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use App\Http\Requests\AdminRequest;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Profile\GetData;
use Illuminate\Support\Facades\Auth;
// use Spatie\Permission\Models\Role;

class Edit extends Component
{
    use LivewireAlert;

    public $admin;
    
    public $name;
    public $email;


    protected $listeners = ['profileUpdate'];

    public function profileUpdate($id)
    {
        $this->admin = Admin::find($id);
    
        if (!$this->admin) {
            // Alert 
            showAlert($this, 'error', 'admin not found');
        }
    
        // Set the properties
        $this->name     = $this->admin->name;
        $this->email    = $this->admin->email;

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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Admin::class)->ignore($this->admin->id)],
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
            // $validatedData['updated_id'] = Auth::guard('admin')->user()->id;

            // Query Create
            $this->admin->update($validatedData);

            // $this->admin->syncRoles();

            // Step 2: Assign Role for Admin
            // if(isset($validatedData['role'])) $this->admin->assignRole($validatedData['role']);

            
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



        return view('admin.pages.profile.partials.edit');
    }
}
