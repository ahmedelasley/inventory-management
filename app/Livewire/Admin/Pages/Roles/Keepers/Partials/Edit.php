<?php

namespace App\Livewire\Admin\Pages\Roles\Keepers\Partials;

use Livewire\Component;
use App\Models\Admin;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleRequest;


use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Roles\Keepers\GetData;

class Edit extends Component
{
    use LivewireAlert;

    public $role;
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

    protected $listeners = ['roleUpdate'];

    public function roleUpdate($id)
    {
        $this->role = Role::find($id);
    
        if (!$this->role) {
            // Alert 
            showAlert($this, 'error', 'role not found');
        }
    
        // Set the properties
        $this->name = $this->role->name;
        $this->permissions = $this->role->permissions->pluck('id')->toArray();    
    
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
        return (new RoleRequest('PUT', $this->role->id))->rules();
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


            $this->role->update($validatedData);

            $this->role->syncPermissions();
            // dd($this->role->permissions);
            if (isset($this->permissions)) {
                $permissions = Permission::find($this->permissions);
                $this->role->givePermissionTo($permissions);
            }

            //Reset 
            $this->reset(); // Clear attributes
            $this->resetValidation();   // Clear Validation
            $this->resetErrorBag(); // Clear errors

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

        $data = Role::where('guard_name', 'keeper')->orderBy('id','DESC')->paginate(50);
        $groups = Permission::where('guard_name', 'keeper')->get();

        return view('admin.pages.roles.keepers.partials.edit', [
            'data' => $data,
            'groups' => $groups,
        ]);
    }
}
