<?php

namespace App\Livewire\Admin\Pages\Sales\Partials;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Restaurant;
use App\Models\Client;
use App\Models\Sale;
use App\Models\SaleStatus;
use App\Livewire\Admin\Pages\Admins\CompleteCreate;
use App\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use LivewireAlert;

    public $restaurant_id;
    public $client_id;

    protected function rules(): array 
    {
        return (new SaleRequest())->rules();
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
            // $validatedData['code'] = 'ORD-' . (sale::count() == 0 ? 1 : (int) str_replace('ORD-', '', sale::latest()->first()->code) + 1);

            $validatedData['code'] = 'INV-' . DB::table('sales')->max('id') + 1;

            // Add additional data
            $validatedData['restaurant_id'] = $this->restaurant_id;
            $validatedData['client_id'] = $this->client_id;
            $validatedData['date'] = now();


            // Associate the sale with the admin user
            $service = Admin::find(Auth::guard('admin')->user()->id);

            // Create the sale record
            $sale = new Sale($validatedData);
            if ($service) {
                $sale->creator()->associate($service);
            }
            $sale->save();

            // Save sale Status
            $saleStatus = new SaleStatus();
            $saleStatus->sale_id = $sale->id;
            $saleStatus->old_status = 'Null';
            $saleStatus->new_status = 'Pending';
            $saleStatus->date = now();
            $saleStatus->statusable()->associate($service);
            $saleStatus->save();

            // Commit transaction
            DB::commit();

            // Reset form fields
            $this->reset();

            // Hide modal
            $this->dispatch('close-modal');

            // Redirect to the next step
            // return redirect()->route('admin.sales.complete-create', ['sale' => $sale]);
            return redirect()->route('admin.sales.create.sale', ['sale' => $sale]);

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
        // $restaurants = Restaurant::select('id', 'name')->get();
        $restaurants = Restaurant::with(['creator', 'editor', 'manager', 'kitchens', 'warehouses'])->get();
// dd($restaurants->kitchen());
        $clients = Client::select('id', 'name')->get();
        // $warehouses = Warehouse::select('id', 'name')->get();
        return view('admin.pages.sales.partials.create', [
            'restaurants' => $restaurants,
            'clients' => $clients,
            // 'warehouses' => $warehouses,
        ]);
    }
}
