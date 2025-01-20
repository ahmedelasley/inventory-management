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

class Edit extends Component
{
    use LivewireAlert;

    public $user;
    
    public $name;
    public $email;
    public $role;


    protected $listeners = ['userUpdate'];

    public function userUpdate($id)
    {
        $this->user = User::find($id);
    
        if (!$this->user) {
            // Alert 
            showAlert($this, 'error', 'user not found');
        }
    
        // Set the properties
        $this->name     = $this->user->name;
        $this->email    = $this->user->email;
        $this->role     = $this->user->getRoleNames()[0];

    
    
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
        return (new UserRequest('PUT', $this->user->id))->rules();
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
            // $validatedData['updated_id'] = Auth::guard('user')->user()->id;

            // Query Create
            $this->user->update($validatedData);

            $this->user->syncRoles();

            // Step 2: Assign Role for user
            if(isset($validatedData['role'])) $this->user->assignRole($validatedData['role']);

            
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


        $roles = Role::where('guard_name', 'web')->get();

        return view('admin.pages.users.partials.edit', [
            'roles' => $roles,
        ]);
    }
}
