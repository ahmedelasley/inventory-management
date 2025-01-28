<?php

namespace App\Livewire\Keeper\Pages\Orders\Partials;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Admin;
use App\Models\Keeper;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Livewire\Keeper\Pages\Orders\GetData;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TrackOrderStatus;

class SendOrder extends Component
{
    use LivewireAlert;

    public $order;
    public $orderType;

    public $code;
    public $type;

    public function mount($order)
    {
        $this->order = $order;
        $this->type = $order->type;
        
    }

    protected $listeners = ['orderSend'];

    public function orderSend($id)
    {
        $this->order = Order::find($id);
    
        if (!$this->order) {
            // Alert 
            showAlert($this, 'error', 'Order not found');
        }
    
        // Set the properties
        $this->code = $this->order->code;
        $this->orderType = $this->order->type;
        $this->type = $this->order->type;

        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('sendOrderModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('sendOrderModalToggle');
    }
    
    public function rules()
    {
        return [
            'type' => 'required|in:Pending,Send,Processed,Shipped,Received',
        ];
    } 
 
    public function updated($field)
    {
        $this->validateOnly($field);
    }



    public function submit()
    {

        // dd($this->order, $this->type);  
        DB::beginTransaction();

        try {
            // Check of Validation
            $validatedData       = $this->validate();

            // Add updater
            $service = Keeper::find(Auth::guard('keeper')->user()->id);

            // Save Order Status
            $orderStatus = new OrderStatus();
            $orderStatus->order_id = $this->order->id;
            $orderStatus->old_status = $this->order->type;
            $orderStatus->new_status = "Send";
            $orderStatus->date = now();
            $orderStatus->statusable()->associate($service);
            $orderStatus->save();

            // Update order
            $this->order->type   = "Send";

            $this->order->updateable()->associate($service);

            $this->order->save(); 

            $details = [
                'order_id' => $this->order->id,
                'title' => "Order from '{$this->order->kitchen->name}'",
                'body' => "A products request has been sent from '{$this->order->kitchen->name}' to the '{$this->order->warehouse->name}' by '{$this->order->updateable->name}'",
            ];
            // Notify the user
            foreach (Admin::get() as $admin) {
                $admin->notify(new TrackOrderStatus($details));
            }
            $this->order->updateable->notify(new TrackOrderStatus($details));
            $this->order->warehouse->keeper->notify(new TrackOrderStatus($details));

            $this->reset();

            // Hide modal
            $this->dispatch('sendOrderModalToggle');
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
        return view('keeper.pages.orders.partials.send-order');
    }
}
