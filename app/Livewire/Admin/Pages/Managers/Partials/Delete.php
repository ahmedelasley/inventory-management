<?php

namespace App\Livewire\Admin\Pages\Managers\Partials;

use Livewire\Component;
use App\Models\Manager;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\managers\GetData;

class Delete extends Component
{

    use LivewireAlert;


    public $manager;
    public $name;

    protected $listeners = ['managerDelete'];

    public function managerDelete($id)
    {
        $this->manager = Manager::find($id);
        $this->name = $this->manager->name;

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
            $this->manager->delete();
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
        return view('admin.pages.managers.partials.delete');
    }
}
