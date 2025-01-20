<?php

namespace App\Livewire\Admin\Pages\Warehouses\Partials;

use Livewire\Component;
use App\Models\Keeper;
use App\Models\Warehouse;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use App\Http\Requests\WarehouseRequest;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Warehouses\GetData;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use LivewireAlert;

    public $warehouse;
    
    public $name;
    public $code;
    public $location;
    public $keeper_id;

    protected $listeners = ['warehouseUpdate'];

    public function warehouseUpdate($id)
    {
        $this->warehouse = Warehouse::find($id);
    
        if (!$this->warehouse) {
            // Alert 
            showAlert($this, 'error', 'Warehouse not found');
        }
    
        // Set the properties
        $this->name            = $this->warehouse->name;
        $this->code            = $this->warehouse->code;
        $this->location        = $this->warehouse->location;
        $this->keeper_id   = $this->warehouse->keeper_id;
    
    
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
        return (new WarehouseRequest('PUT', $this->warehouse->id))->rules();
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

            // Add updater
            $validatedData['updated_id'] = Auth::guard('admin')->user()->id;

            // Query Create
            $this->warehouse->update($validatedData);

            $this->reset();

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

        $data = Keeper::with(['creator', 'updater'])->paginate(20);
        return view('admin.pages.warehouses.partials.edit', [
            'data' => $data,
        ]);
    }
}
