<?php

namespace App\Livewire\Manager\Pages\Suppliers\Partials;

use Livewire\Component;
use App\Models\Supplier;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Livewire\Manager\Pages\Suppliers\GetData;

class Delete extends Component
{

    use LivewireAlert;


    public $supplier;
    public $name;

    protected $listeners = ['supplierDelete'];

    public function supplierDelete($id)
    {
        $this->supplier = Supplier::find($id);
        $this->name = $this->supplier->name;

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
            $this->supplier->delete();
            $this->reset('supplier');
            // Hide modal
            $this->dispatch('deleteModalToggle');

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
        return view('manager.pages.suppliers.partials.delete');
    }
}
