<?php

namespace App\Livewire\Admin\Pages\Roles\Managers\Partials;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleRequest;

use App\Livewire\Admin\Pages\Roles\Managers\GetData;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use LivewireAlert;
    // protected $listeners = ['refreshForm' => '$refresh'];

    // public $name, $description, $parent_id; 
    public $name;
    public $permissions = [];

    public function toggleType($type)
    {
        $permissions = \Spatie\Permission\Models\Permission::where('type', $type)->pluck('id')->toArray();
    
        // إذا كانت جميع الصلاحيات موجودة في المصفوفة، قم بإلغاء التحديد
        if (count(array_intersect($this->permissions, $permissions)) == count($permissions)) {
            $this->permissions = array_diff($this->permissions, $permissions);
        } else {
            // إضافة الصلاحيات التي لم يتم تحديدها بعد
            $this->permissions = array_unique(array_merge($this->permissions, $permissions));
        }
    }
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
            
            $role = Role::create( ['name' => $validatedData['name'], 'guard_name' => 'manager' ]);

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
        $data = Role::where('guard_name', 'manager')->orderBy('id','DESC')->paginate(50);
        $groups = Permission::where('guard_name', 'manager')->get();

        return view('admin.pages.roles.Managers.partials.create', [
            'data' => $data,
            'groups' => $groups,
        ]);
    }
}
