<?php

namespace App\Livewire\Keeper\Pages\Purchases\Partials;

use Livewire\Component;
use App\Models\Keeper;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\Purchase;
// use App\Livewire\Keeper\Pages\keepers\CompleteCreate;
// use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use LivewireAlert;

    public $supplier_id;

    protected function rules(): array 
    {
        return [
            'supplier_id' => 'required|exists:suppliers,id',
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
            // Validate data
            $validatedData = $this->validate();

            // Generate unique code
            $validatedData['code'] = 'PUR-' . (Purchase::count() == 0 ? 1 : (int) str_replace('PUR-', '', Purchase::latest()->first()->code) + 1);

            // Add additional data
            $validatedData['warehouse_id'] = Auth::guard('keeper')->user()->warehouse->id;
            $validatedData['supplier_id'] = $this->supplier_id;
            $validatedData['business_date'] = now();


            // Associate the purchase with the keeper user
            $service = Keeper::find(Auth::guard('keeper')->user()->id);
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
            // return redirect()->route('keeper.purchases.complete-create', ['purchase' => $purchase]);
            return redirect()->route('keeper.purchases.create.purchase', ['purchase' => $purchase]);

            // Alert success
            showAlert($this, 'success', __('Done Added Data Successfully'));
        } catch (Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            // Alert error
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
        $suppliers = Supplier::select('id', 'name')->get();
        // $warehouses = Warehouse::select('id', 'name')->get();
        return view('keeper.pages.purchases.partials.create', [
            'suppliers' => $suppliers,
            // 'warehouses' => $warehouses,
        ]);
    }
}
