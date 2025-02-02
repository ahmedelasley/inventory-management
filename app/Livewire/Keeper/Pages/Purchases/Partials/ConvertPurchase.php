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

class ConvertPurchase extends Component
{
    use LivewireAlert;

    public $purchase;

    public $code;
    public $type;

    public function mount($purchase)
    {
        $this->purchase = $purchase;
    }

    protected $listeners = ['purchaseConvert'];

    public function purchaseConvert($id)
    {
        $this->purchase = Purchase::find($id);
    
        if (!$this->purchase) {
            // Alert 
            showAlert($this, 'error', 'Purchase not found');
        }
    
        // Set the properties
        $this->code    = $this->purchase->code;
        $this->type  = $this->purchase->type;

        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('convertPurchaseModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('convertPurchaseModalToggle');
    }
    
    public function rules()
    {
        return [
            'type' => 'required|in:Draft,Purchasing,Return',
        ];
    } 
 
    public function updated($field)
    {
        $this->validateOnly($field);
    }



    public function submit()
    {

        // dd($this->purchase, $this->type);  
        DB::beginTransaction();

        try {
            // Check of Validation
            $validatedData       = $this->validate();

            // Add updater
            $service = Keeper::find(Auth::guard('keeper')->user()->id);
            
            // Update purchase
            $this->purchase->type   = $validatedData['type'];

            $this->purchase->updateable()->associate($service);
            $this->purchase->save(); 

            $this->reset();

            // Hide modal
            $this->dispatch('convertPurchaseModalToggle');
            $this->dispatch('refreshTitle'); 

            // Refresh skills data component
            // $this->dispatch(['refreshData'])->to(GetData::class);
            
            // Alert 
            showAlert($this, 'success', __('Done Saved Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction            
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        }
    }



    public function render()
    {
        return view('keeper.pages.purchases.partials.convert-purchase');
    }
}
