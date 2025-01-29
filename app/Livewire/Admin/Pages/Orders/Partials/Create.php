<?php

namespace App\Livewire\Admin\Pages\Orders\Partials;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Restaurant;
use App\Models\Warehouse;
use App\Models\Kitchen;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Livewire\Admin\Pages\Admins\CompleteCreate;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use LivewireAlert;

    public $kitchen_id;
    public $warehouse_id;

    protected function rules(): array 
    {
        return (new OrderRequest())->rules();
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
            // $validatedData['code'] = 'ORD-' . (Order::count() == 0 ? 1 : (int) str_replace('ORD-', '', Order::latest()->first()->code) + 1);

            $validatedData['code'] = 'ORD-' . DB::table('orders')->max('id') + 1;

            // Add additional data
            $validatedData['kitchen_id'] = $this->kitchen_id;
            $validatedData['warehouse_id'] = $this->warehouse_id;
            $validatedData['request_date'] = now();


            // Associate the order with the admin user
            $service = Admin::find(Auth::guard('admin')->user()->id);

            // Create the order record
            $order = new Order($validatedData);
            if ($service) {
                $order->createable()->associate($service);
            }
            $order->save();

            // Save Order Status
            $orderStatus = new OrderStatus();
            $orderStatus->order_id = $order->id;
            $orderStatus->old_status = 'Null';
            $orderStatus->new_status = 'Pending';
            $orderStatus->date = now();
            $orderStatus->statusable()->associate($service);
            $orderStatus->save();

            // Commit transaction
            DB::commit();

            // Reset form fields
            $this->reset();

            // Hide modal
            $this->dispatch('close-modal');

            // Redirect to the next step
            // return redirect()->route('admin.orders.complete-create', ['order' => $order]);
            return redirect()->route('admin.orders.create.order', ['order' => $order]);

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
        $restaurants = Restaurant::with(['creator', 'editor', 'user', 'kitchens', 'warehouses'])->get();
// dd($restaurants->kitchen());
        // $kitchens = Kitchen::select('id', 'name')->get();
        // $warehouses = Warehouse::select('id', 'name')->get();
        return view('admin.pages.orders.partials.create', [
            'restaurants' => $restaurants,
            // 'kitchens' => $kitchens,
            // 'warehouses' => $warehouses,
        ]);
    }
}
