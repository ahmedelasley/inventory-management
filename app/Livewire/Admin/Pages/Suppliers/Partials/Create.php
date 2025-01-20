<?php

namespace App\Livewire\Admin\Pages\Suppliers\Partials;

use Livewire\Component;
use App\Models\Supplier;
use App\Livewire\Admin\Pages\Suppliers\GetData;
use App\Http\Requests\SupplierRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use LivewireAlert;

    public $name, $phone, $email, $address; 

    protected function rules(): array 
    {
        return (new SupplierRequest('POST'))->rules();
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

            // Add creator
            $validatedData['code'] = 'Sup-' . ( Supplier::count() == 0 ? getSetting('supplier_code') + 1 : (int) str_replace('Sup-', '', Supplier::latest()->first()->code) + 1 );
            $validatedData['created_id'] = Auth::guard('admin')->user()->id;

            // Query Create
            Supplier::create($validatedData);

            $this->reset();

            // Hide modal
            $this->dispatch('close-modal');

            // Refresh skills data component
            $this->dispatch('refreshData')->to(GetData::class);
            // $this->dispatch('refreshForm')->to(Create::class);
            
            // Alert 
            showAlert($this, 'success', __('Done Added Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction            
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        }
    }

    public function closeForm()
    {
        //Reset 
        $this->reset(); // Clear attributes
        $this->resetValidation();   // Clear Validation
        $this->resetErrorBag(); // Clear errors

        $this->dispatch('close-modal'); // Trigger modal close via JS
    }

    public function render()
    {
        // $data = Suppliers::with(['parent', 'children'])->paginate(20);
        return view('admin.pages.suppliers.partials.create');
    }
}
