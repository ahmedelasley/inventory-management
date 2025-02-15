<?php

namespace App\Livewire\Admin\Pages\Sales\Partials;

use Livewire\Component;
use App\Models\Sale;
use App\Models\SaleStatus;
use App\Models\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Sales\GetData;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TrackSaleStatus;

class ConvertSale extends Component
{
    use LivewireAlert;

    public $sale;
    public $saleType;

    public $code;
    public $type;
    public $response_date;

    public function mount($sale)
    {
        $this->sale = $sale;
        $this->type = $sale->type;
        $this->response_date = $sale->response_date;
        
    }

    protected $listeners = ['saleConvert'];

    public function saleConvert($id)
    {
        $this->sale = Sale::find($id);
    
        if (!$this->sale) {
            // Alert 
            showAlert($this, 'error', 'sale not found');
        }
    
        // Set the properties
        $this->code = $this->sale->code;
        $this->saleType = $this->sale->type;
        $this->type = $this->sale->type;

        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('convertsaleModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('convertsaleModalToggle');
    }
    
    public function rules()
    {
        return [
            'type' => 'required|in:Pending,Send,Processed,Shipped,Received',
            // 'response_date' => 'nullable|date|required_if:type,Processed', 
        ];
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
            $service = Admin::find(Auth::guard('admin')->user()->id);

            // Save sale Status
            $saleStatus = new SaleStatus();
            $saleStatus->sale_id = $this->sale->id;
            $saleStatus->old_status = $this->sale->type;
            $saleStatus->new_status = $validatedData['type'];
            $saleStatus->date = now();
            $saleStatus->statusable()->associate($service);
            $saleStatus->save();

            // Update sale
            $this->sale->type   = $validatedData['type'];

            if ($this->sale->type == $this->type) {
                $this->sale->response_date   = now();
            }

            $this->sale->updateable()->associate($service);

            $this->sale->save(); 


            $details = [
                'sale_id' => $this->sale->id,
                'title' => "'{$this->sale->type}' '{$this->sale->code}' from Administrator",
                'body' => "A products request has been Processing from '{$service->name}' to the '{$this->sale->kitchen->name}' by '{$this->sale->updateable->name}'",
            ];
            // Notify the user
            foreach (Admin::where('id', '!=', Auth::guard('admin')->user()->id)->get() as $admin) {
                $admin->notify(new TrackSaleStatus($details));
            }
            $this->sale->updateable->notify(new TrackSaleStatus($details));
            $this->sale->kitchen->supervisor->notify(new TrackSaleStatus($details));


            $this->reset();

            // Hide modal
            $this->dispatch('convertsaleModalToggle');
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
        return view('admin.pages.sales.partials.convert-sale');
    }
}
