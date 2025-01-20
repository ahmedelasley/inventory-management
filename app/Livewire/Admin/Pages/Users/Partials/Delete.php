<?php

namespace App\Livewire\Admin\Pages\Users\Partials;

use Livewire\Component;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Users\GetData;

class Delete extends Component
{

    use LivewireAlert;


    public $user;
    public $name;

    protected $listeners = ['userDelete'];

    public function userDelete($id)
    {
        $this->user = User::find($id);
        $this->name = $this->user->name;

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
            $this->user->delete();
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
        return view('admin.pages.users.partials.delete');
    }
}
