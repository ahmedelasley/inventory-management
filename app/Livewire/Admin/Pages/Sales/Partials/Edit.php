<?php

namespace App\Livewire\Admin\Pages\Sales\Partials;

use Livewire\Component;
use App\Models\Restaurant;
use App\Models\Client;
use App\Models\Sale;
use App\Models\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Sales\GetData;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use LivewireAlert;

    public $sale;
    public $sale_id;
    public $code;
    public $restaurant_id;
    public $client_id;
    public $date;
    public float $tax;
    public $notes;


    public $rules = [];

    public function mount($sale)
    {
        $this->sale = $sale;
        $this->sale_id = $sale->id;
        $this->date = $sale->date;
    }

    protected $listeners = ['saleUpdate'];

    public function saleUpdate($id)
    {
        $this->sale = Sale::find($id);
    
        if (!$this->sale) {
            // Alert 
            showAlert($this, 'error', 'sale not found');
        }
    

        // Set the properties
        $this->code           = $this->sale->code;
        $this->restaurant_id  = $this->sale->restaurant_id;
        $this->client_id      = $this->sale->client_id;
        $this->date           = $this->sale->date;
        $this->tax            = $this->sale->tax;
        $this->notes          = $this->sale->notes;
    
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('editSaleModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('editSaleModalToggle');
    }
    
    public function rules()
    {
        $this->rules = [
            'restaurant_id' => 'required|exists:restaurants,id',
            'client_id' => 'required|exists:clients,id',
            'date'      => 'required|date',
            // 'invoice_number'    => 'required|string',
            'tax'               => 'required|numeric|decimal:0,4|gte:0',
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

            $this->sale->update($validatedData);

            // Add updater
            $service = Admin::find(Auth::guard('admin')->user()->id);
            $this->sale->editor()->associate($service);
            $this->sale->save(); 

            // $this->reset();

            // Hide modal
            $this->dispatch('editSaleModalToggle');

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
        $restaurants = Restaurant::with(['creator', 'editor', 'manager', 'kitchens', 'warehouses'])->get();
        $clients = Client::select('id', 'name')->get();

        return view('admin.pages.sales.partials.edit', [
            'restaurants' => $restaurants,
            'clients' => $clients,

        ]);
    }
}
