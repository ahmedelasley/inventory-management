<?php

namespace App\Livewire\Admin\Pages\Suppliers\Partials;

use Livewire\Component;
use App\Models\Supplier;

class Show extends Component
{

    public $supplier;
    
    public $name;
    public $code;
    public $phone;
    public $email;
    public $address;
    
    protected $listeners = ['supplierShow'];

    public function supplierShow($id)
    {
        $this->supplier = Supplier::find($id);
    
        if (!$this->supplier) {
            // Alert 
            showAlert($this, 'error', 'supplier not found');
        }
    
        // Set the properties
        $this->name     = $this->supplier->name;
        $this->code     = $this->supplier->code;
        $this->phone    = $this->supplier->phone;
        $this->email    = $this->supplier->email;
        $this->address  = $this->supplier->address;

        // Open modal
        $this->dispatch('showModalToggle');
    }

    public function closeForm()
    {   
        // Close modal
        $this->dispatch('showModalToggle');
    }
    
    public function render()
    {

        return view('admin.pages.suppliers.partials.show');
    }
}
