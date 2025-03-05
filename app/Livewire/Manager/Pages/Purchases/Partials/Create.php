<?php

namespace App\Livewire\Manager\Pages\Purchases\Partials;

use Livewire\Component;
use App\Models\Manager;
use App\Models\Restaurant;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\Purchase;
use App\Livewire\Manager\Pages\Managers\CompleteCreate;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use LivewireAlert;

    public $warehouse_id;
    public $supplier_id;

    protected function rules(): array 
    {
        return (new PurchaseRequest())->rules();
    } 
 
    public function updated($field)
    {
        $this->validateOnly($field);
    }


    public function submit()
{
    DB::beginTransaction();

    try {
        // Validate data
        $validatedData = $this->validate();

        // Generate unique code
        $validatedData['code'] = 'PUR-' . (Purchase::count() == 0 ? 1 : (int) str_replace('PUR-', '', Purchase::latest()->first()->code) + 1);

        // Add additional data
        $validatedData['warehouse_id'] = $this->warehouse_id;
        $validatedData['supplier_id'] = $this->supplier_id;
        $validatedData['business_date'] = now();


        // Associate the purchase with the manager user
        $service = Manager::find(Auth::guard('manager')->user()->id);
        // Create the purchase record
        $purchase = new Purchase($validatedData);
        if ($service) {
            $purchase->createable()->associate($service);
        }
        $purchase->save();

        // Commit transaction
        DB::commit();

        // Reset form fields
        $this->reset();

        // Hide modal
        $this->dispatch('close-modal');

        // Redirect to the next step
        // return redirect()->route('manager.purchases.complete-create', ['purchase' => $purchase]);
        return redirect()->route('manager.purchases.create.purchase', ['purchase' => $purchase]);

        // Alert success
        showAlert($this, 'success', __('Done Added Data Successfully'));
    } catch (Exception $e) {
        // Rollback transaction on error
        DB::rollBack();

        // Alert error
        showAlert($this, 'error', $e->getMessage());
    }
}

    
    // public function submit()
    // {


    //     DB::beginTransaction();

    //     try {
    //         // Check of Validation
    //         $validatedData       = $this->validate();

    //         // Add creator
    //         $validatedData['code'] = 'PUR-' . ( Purchase::count() == 0 ? 1 : (int) str_replace('PUR-', '', Purchase::latest()->first()->code) + 1 );

    //         $service = Manager::find(Auth::guard('manager')->user()->id); // Find the service you want to associate

    //         $validatedData['warehouse_id'] = $this->warehouse_id;
    //         $validatedData['supplier_id'] = $this->supplier_id;

    //         $purchase = Purchase::create($validatedData);
    //         $purchase->associate($service); // Associate the service

    //         $this->reset();

    //         // Hide modal
    //         $this->dispatch('close-modal');

    //         // redirect data component
    //         return redirect()->route('manager.purchases.complete-create', ['id' => $purchase->id]);
    //         // Alert 
    //         showAlert($this, 'success', __('Done Added Data Successfully'));

    //         DB::commit(); // All database operations are successful, commit the transaction            
    //     } catch (Exception $e) {

    //         DB::rollBack(); // Something went wrong, roll back the transaction

    //         // Alert 
    //         showAlert($this, 'error', $e->getMessage());
    //     }
    // }

    public function closeForm()
    {
        //Reset 
        $this->reset(); // Clear attributes
        $this->resetValidation();   // Clear Validation
        $this->resetErrorBag(); // Clear errors

        $this->dispatch('close-modal'); // Trigger modal close via JS
    }
    public function resetForm()
    {
        //Reset 
        $this->reset(); // Clear attributes
        $this->resetValidation();   // Clear Validation
        $this->resetErrorBag(); // Clear errors

        // $this->dispatch('close-modal'); // Trigger modal close via JS
    }
    public function render()
    {
        $restaurants = Restaurant::with(['creator', 'editor', 'manager', 'kitchens', 'warehouses'])->get();

        $suppliers = Supplier::select('id', 'name')->get();
        // $warehouses = Warehouse::select('id', 'name')->get();
        return view('manager.pages.purchases.partials.create', [
            'restaurants' => $restaurants,
            'suppliers' => $suppliers,
            // 'warehouses' => $warehouses,
        ]);
    }
}
