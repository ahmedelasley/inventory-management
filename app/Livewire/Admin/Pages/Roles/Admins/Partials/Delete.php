<?php

namespace App\Livewire\Admin\Pages\Roles\Admins\Partials;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Roles\Admins\GetData;

class Delete extends Component
{

    use LivewireAlert;


    public $role;
    public $name;

    protected $listeners = ['roleDelete'];

    public function roleDelete($id)
    {
        $this->role = Role::find($id);
        $this->name = $this->role->name;

        $this->dispatch('deleteModalToggle');
    }
    public function closeForm()
    {    
        // Close modal
        $this->dispatch('deleteModalToggle');
    }
    public function submit()
    {
        DB::beginTransaction();

        try {

            // Query Create
            $this->role->delete();
            // $this->reset('product');

            // Hide modal
            $this->dispatch('deleteModalToggle');

            // Refresh skills data component
            $this->dispatch(['refreshData'])->to(GetData::class);
            // $this->dispatch('productDelete')->to(GetData::class);

            // Alert 
            showAlert($this, 'success', __('Done Deleted Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction            
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('admin.pages.roles.admins.partials.delete');
    }
}
