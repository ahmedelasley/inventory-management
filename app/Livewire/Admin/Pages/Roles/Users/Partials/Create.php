<?php

namespace App\Livewire\Admin\Pages\Roles\Users\Partials;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleRequest;

use App\Livewire\Admin\Pages\Roles\Users\GetData;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class Create extends Component
{
    use LivewireAlert;
    // protected $listeners = ['refreshForm' => '$refresh'];

    // public $name, $description, $parent_id; 
    public $name;
    public $permissions = [];


    protected function rules(): array 
    {
        // return [
        //     'name' => 'required|string|unique:roles,name',
        //     'permissions.*' => 'nullable',
        // ];
        return (new RoleRequest())->rules();

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
            
            $role = Role::create( ['name' => $validatedData['name'], 'guard_name' => 'web' ]);

            if (isset($this->permissions)) {
                $permissions = Permission::find($this->permissions);
                $role->syncPermissions($permissions);
            }

            //Reset 
            $this->reset(); // Clear attributes
            $this->resetValidation();   // Clear Validation
            $this->resetErrorBag(); // Clear errors

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
        $data = Role::where('guard_name', 'web')->orderBy('id','DESC')->paginate(50);
        $groups = Permission::where('guard_name', 'web')->get();

        return view('admin.pages.roles.users.partials.create', [
            'data' => $data,
            'groups' => $groups,
        ]);
    }
}
