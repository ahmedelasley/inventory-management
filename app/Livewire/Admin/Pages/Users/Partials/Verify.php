<?php

namespace App\Livewire\Admin\Pages\Users\Partials;

use Livewire\Component;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Users\GetData;
use Illuminate\Support\Facades\Auth;

class Verify extends Component
{
    use LivewireAlert;

    public $user;
    public $name;
    public $email_verified_at;

    protected $listeners = ['userVerify'];

    public function userVerify($id)
    {
        $this->user = User::find($id);

        $this->name = $this->user->name;
        $this->email_verified_at = $this->user->email_verified_at;

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
            $this->user->email_verified_at == null ? $this->user->email_verified_at = Now() : $this->user->email_verified_at = null;

            $this->user->save();


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

        return view('admin.pages.users.partials.verify');
    }
}
