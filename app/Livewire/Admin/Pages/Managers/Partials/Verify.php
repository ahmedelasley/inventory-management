<?php

namespace App\Livewire\Admin\Pages\Managers\Partials;

use Livewire\Component;
use App\Models\Manager;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Managers\GetData;
use Illuminate\Support\Facades\Auth;

class Verify extends Component
{
    use LivewireAlert;

    public $manager;
    public $name;
    public $email_verified_at;

    protected $listeners = ['managerVerify'];

    public function managerVerify($id)
    {
        $this->manager = Manager::find($id);

        $this->name = $this->manager->name;
        $this->email_verified_at = $this->manager->email_verified_at;

        $this->dispatch('verifyModalToggle');
    }

    public function closeForm()
    {    
        // Close modal
        $this->dispatch('verifyModalToggle');
    }

    public function submit()
    {
        DB::beginTransaction();

        try {

            // Query Create
            $this->manager->email_verified_at == null ? $this->manager->email_verified_at = Now() : $this->manager->email_verified_at = null;

            $this->manager->save();


            // Hide modal
            $this->dispatch('verifyModalToggle');

            // Refresh skills data component
            $this->dispatch(['refreshData'])->to(GetData::class);

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

        return view('admin.pages.managers.partials.verify');
    }
}
