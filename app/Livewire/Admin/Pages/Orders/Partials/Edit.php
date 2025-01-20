<?php

namespace App\Livewire\Admin\Pages\Orders\Partials;

use Livewire\Component;
use App\Models\Kitchen;
use App\Models\Warehouse;
use App\Models\Order;
use App\Models\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Orders\GetData;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use LivewireAlert;

    public $order;
    public $order_id;
    public $code;
    public $warehouse_id;
    public $kitchen_id;
    public $request_date;
    // public float $tax;
    // public float $additional_cost;
    // public float $discount;
    // public $invoice_date;
    // public $business_date;
    public $notes;


    public $rules = [];

    public function mount($order)
    {
        $this->order = $order;
        $this->order_id = $order->id;
    }

    protected $listeners = ['orderUpdate'];

    public function orderUpdate($id)
    {
        $this->order = Order::find($id);
    
        if (!$this->order) {
            // Alert 
            showAlert($this, 'error', 'order not found');
        }
    

        // Set the properties
        $this->code             = $this->order->code;
        $this->warehouse_id     = $this->order->warehouse_id;
        $this->kitchen_id      = $this->order->kitchen_id;
        $this->request_date   = $this->order->request_date;

        // $this->tax              = $this->order->tax;
        // $this->additional_cost  = $this->order->additional_cost;
        // $this->discount         = $this->order->discount;
        // $this->request_date     = $this->order->request_date;
        // $this->business_date    = $this->order->business_date;
        $this->notes            = $this->order->notes;
    
        // dd($this->supplier_id);
        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('editOrderModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('editOrderModalToggle');
    }
    
    public function rules()
    {
        $this->rules = [
            'warehouse_id'      => 'required|exists:warehouses,id',
            'kitchen_id'       => 'required|exists:kitchens,id',
            'request_date'      => 'required|date',
            // 'invoice_number'    => 'required|string',
            // 'tax'               => 'required|numeric|decimal:0,4|gte:0',
            // 'additional_cost'   => 'required|numeric|decimal:0,4|gte:0',
            // 'discount'          => 'required|numeric|decimal:0,4|gte:0',
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

            $this->order->update($validatedData);

            // Add updater
            $service = Admin::find(Auth::guard('admin')->user()->id);
            $this->order->updateable()->associate($service);
            $this->order->save(); 

            $this->reset();

            // Hide modal
            $this->dispatch('editOrderModalToggle');

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
        $kitchens = Kitchen::select('id', 'name')->get();
        $warehouses = Warehouse::select('id', 'name')->get();
        return view('admin.pages.orders.partials.edit', [
            'kitchens' => $kitchens,
            'warehouses' => $warehouses,
        ]);

    }
}
