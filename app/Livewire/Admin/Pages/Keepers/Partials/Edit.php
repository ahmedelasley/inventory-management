<?php

namespace App\Livewire\Admin\Pages\Keepers\Partials;

use Livewire\Component;
use App\Models\Keeper;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use App\Http\Requests\KeeperRequest;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Keepers\GetData;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    use LivewireAlert;

    public $keeper;
    
    public $name;
    public $email;
    public $role;


    protected $listeners = ['keeperUpdate'];

    public function keeperUpdate($id)
    {
        $this->keeper = Keeper::find($id);
    
        if (!$this->keeper) {
            // Alert 
            showAlert($this, 'error', 'keeper not found');
        }
    
        // Set the properties
        $this->name     = $this->keeper->name;
        $this->email    = $this->keeper->email;
        $this->role     = $this->keeper->getRoleNames()[0];

    
    
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
        return (new KeeperRequest('PUT', $this->keeper->id))->rules();
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
            // $validatedData['updated_id'] = Auth::guard('keeper')->user()->id;

            // Query Create
            $this->keeper->update($validatedData);
            $this->keeper->syncRoles();

            // Step 2: Assign Role for Keeper
            if(isset($validatedData['role'])) $this->keeper->assignRole($validatedData['role']);

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


        $roles = Role::where('guard_name', 'keeper')->get();

        return view('admin.pages.keepers.partials.edit', [
            'roles' => $roles,
        ]);
    }
}
