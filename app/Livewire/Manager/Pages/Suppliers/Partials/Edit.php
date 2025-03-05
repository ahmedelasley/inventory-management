<?php

namespace App\Livewire\Manager\Pages\Suppliers\Partials;

use Livewire\Component;
use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Livewire\Manager\Pages\Suppliers\GetData;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use LivewireAlert;

    public $supplier;
    public $name, $phone, $email, $address; 

    protected $listeners = ['supplierUpdate'];

    public function supplierUpdate($id)
    {
        $this->supplier = Supplier::find($id);
    
        if (!$this->supplier) {
            // Alert 
            showAlert($this, 'error', 'supplier not found');
        }
    
        // Set the properties
        $this->name = $this->supplier->name;
        $this->phone = $this->supplier->phone;
        $this->email = $this->supplier->email;
        $this->address = $this->supplier->address;
    
    
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
        return (new SupplierRequest('PUT', $this->supplier->id))->rules();
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
            $validatedData['updated_id'] = Auth::guard('manager')->user()->id;

            // Query Create
            $this->supplier->update($validatedData);

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
        return view('manager.pages.suppliers.partials.edit');
    }
}
