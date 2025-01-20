<?php

namespace App\Livewire\Admin\Pages\Kitchens\Partials;

use Livewire\Component;
use App\Models\Kitchen;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Kitchens\GetData;

class Delete extends Component
{

    use LivewireAlert;


    public $kitchen;
    public $name;

    protected $listeners = ['kitchenDelete'];

    public function kitchenDelete($id)
    {
        $this->kitchen = Kitchen::find($id);
        $this->name = $this->kitchen->name;

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
            $this->kitchen->delete();
            $this->reset('kitchen');
            // Hide modal
            $this->dispatch('deleteModalToggle');

            // Refresh skills data component
            $this->dispatch(['refreshData'])->to(GetData::class);
            // $this->dispatch('kitchenDelete')->to(GetData::class);

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
        return view('admin.pages.kitchens.partials.delete');
    }
}
