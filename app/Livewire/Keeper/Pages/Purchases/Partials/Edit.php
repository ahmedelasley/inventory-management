<?php

namespace App\Livewire\Keeper\Pages\Purchases\Partials;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\Purchase;
use App\Models\Keeper;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Keeper\Pages\Purchases\GetData;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use LivewireAlert;

    public $purchase;
    public $purchase_id;
    public $code;
    // public $warehouse_id;
    public $supplier_id;
    public $invoice_number;
    public float $tax;
    public float $additional_cost;
    public float $discount;
    public $invoice_date;
    public $business_date;
    public $notes;


    public $rules = [];

    public function mount($purchase)
    {
        $this->purchase = $purchase;
        $this->purchase_id = $purchase->id;
    }

    protected $listeners = ['purchaseUpdate'];

    public function purchaseUpdate($id)
    {
        $this->purchase = Purchase::find($id);
    
        if (!$this->purchase) {
            // Alert 
            showAlert($this, 'error', 'Purchase not found');
        }
    

        // Set the properties
        $this->code             = $this->purchase->code;
        // $this->warehouse_id     = $this->purchase->warehouse_id;
        $this->supplier_id      = $this->purchase->supplier_id;
        $this->invoice_number   = $this->purchase->invoice_number;

        $this->tax              = $this->purchase->tax;
        $this->additional_cost  = $this->purchase->additional_cost;
        $this->discount         = $this->purchase->discount;
        $this->invoice_date     = $this->purchase->invoice_date;
        $this->business_date    = $this->purchase->business_date;
        $this->notes            = $this->purchase->notes;
    
        // dd($this->supplier_id);
        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('editPurchaseModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('editPurchaseModalToggle');
    }
    
    public function rules()
    {
        $this->rules = [
            // 'warehouse_id'      => 'required|exists:warehouses,id',
            'supplier_id'       => 'required|exists:suppliers,id',
            'invoice_date'      => 'required|date',
            'invoice_number'    => 'required|string',
            'tax'               => 'required|numeric|decimal:0,4|gte:0',
            'additional_cost'   => 'required|numeric|decimal:0,4|gte:0',
            'discount'          => 'required|numeric|decimal:0,4|gte:0',
            'notes'             => 'nullable|string|max:255',


        ];

        // if ($this->production_date) {
        //     $this->rules['expiration_date'] = 'required|date|after_or_equal:production_date';
        // }

        return $this->rules;
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

            $this->purchase->update($validatedData);

            // Add updater
            $service = Keeper::find(Auth::guard('keeper')->user()->id);
            $this->purchase->updateable()->associate($service);
            $this->purchase->save(); 

            $this->reset();

            // Hide modal
            $this->dispatch('editPurchaseModalToggle');

            // Refresh skills data component
            // $this->dispatch(['refreshData'])->to(Index::class);
            // $this->dispatch(['refreshData'])->to(GetData::class);

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
        $suppliers = Supplier::select('id', 'name')->get();
        // $warehouses = Warehouse::select('id', 'name')->get();
        return view('keeper.pages.purchases.partials.edit', [
            'suppliers' => $suppliers,
            // 'warehouses' => $warehouses,
        ]);

    }
}
