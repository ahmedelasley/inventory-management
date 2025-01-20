<?php

namespace App\Livewire\Admin\Pages\Supervisors\Partials;

use Livewire\Component;
use App\Models\Supervisor;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Supervisors\GetData;

class Delete extends Component
{

    use LivewireAlert;


    public $supervisor;
    public $name;

    protected $listeners = ['supervisorDelete'];

    public function supervisorDelete($id)
    {
        $this->supervisor = Supervisor::find($id);
        $this->name = $this->supervisor->name;

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
            $this->supervisor->delete();
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
        return view('admin.pages.supervisors.partials.delete');
    }
}
