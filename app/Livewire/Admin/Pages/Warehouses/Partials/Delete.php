<?php

namespace App\Livewire\Admin\Pages\Warehouses\Partials;

use Livewire\Component;
use App\Models\Warehouse;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Warehouses\GetData;

class Delete extends Component
{

    use LivewireAlert;


    public $warehouse;
    public $name;

    protected $listeners = ['warehouseDelete'];

    public function warehouseDelete($id)
    {
        $this->warehouse = Warehouse::find($id);
        $this->name = $this->warehouse->name;

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
            $this->warehouse->delete();
            $this->reset();
            // Hide modal
            $this->dispatch('deleteModalToggle');

            // Refresh skills data component
            $this->dispatch(['refreshData'])->to(GetData::class);
            // $this->dispatch('WarehouseDelete')->to(GetData::class);

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
        return view('admin.pages.warehouses.partials.delete');
    }
}
