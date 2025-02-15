<?php

namespace App\Livewire\Admin\Pages\Managers\Partials;

use Livewire\Component;
use App\Models\Manager;
use App\Livewire\Admin\Pages\managers\GetData;
use App\Http\Requests\ManagerRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use LivewireAlert;
    // protected $listeners = ['refreshForm' => '$refresh'];

    // public $name, $description, $parent_id; 
    public $name;
    public $email;
    public $role;


    protected function rules(): array 
    {
        return (new ManagerRequest())->rules();
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

            // Add Password
            $validatedData['password'] = bcrypt('password');

            // Query Create
            $manager = Manager::create($validatedData);
            // Step 2: Assign Role for manager
            if(isset($validatedData['role'])) $manager->assignRole($validatedData['role']);

            $this->reset();

            // Hide modal
            $this->dispatch('close-modal');

            // Refresh skills data component
            $this->dispatch('refreshData')->to(GetData::class);
            // $this->dispatch('refreshForm')->to(Create::class);
            
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
    public function resetForm()
    {
        //Reset 
        $this->reset(); // Clear attributes
        $this->resetValidation();   // Clear Validation
        $this->resetErrorBag(); // Clear errors

        // $this->dispatch('close-modal'); // Trigger modal close via JS
    }
    public function render()
    {
        $roles = Role::where('guard_name', 'manager')->get();

        return view('admin.pages.managers.partials.create', [
            'roles' => $roles,
        ]);
    }
}
