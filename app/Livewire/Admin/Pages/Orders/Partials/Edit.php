<?php

namespace App\Livewire\Admin\Pages\Orders\Partials;

use Livewire\Component;
use App\Models\Restaurant;
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
    public $request_date;
    // public float $tax;
    // public float $additional_cost;
    // public float $discount;
    // public $invoice_date;
    // public $business_date;
    public $notes;

    public $restaurants;
    public $kitchen_id;
    public $warehouse_id;
    public $warehouses = []; // قائمة المستودعات التي ستتغير ديناميكيًا


    public $rules = [];

    public function mount($order)
    {
        $this->order = $order;
        $this->order_id = $order->id;
        $this->restaurants = Restaurant::with(['kitchens', 'warehouses'])->get() ?? collect();
        
        // تعيين المطبخ والمستودع من الطلب الحالي
        $this->kitchen_id = $order->kitchen_id;
        $this->warehouse_id = $order->warehouse_id;
    
        // جلب المستودعات الخاصة بالمطبخ المحدد مسبقًا
        $this->warehouses = $this->getWarehousesForKitchen($this->kitchen_id);
    }
    
    // جلب المستودعات بناءً على المطبخ المحدد
    private function getWarehousesForKitchen($kitchenId)
    {
        $kitchen = Kitchen::find($kitchenId);
        return $kitchen && $kitchen->restaurant ? $kitchen->restaurant->warehouses->toArray() : [];
    }
    

    public function updatedKitchenId($value)
    {
        $this->warehouse_id = null; // إعادة تعيين المستودع عند تغيير المطبخ
        $this->warehouses = []; // إعادة تعيين المستودعات إلى مصفوفة فارغة
    
        if ($value) {
            // جلب المطبخ المختار
            $kitchen = Kitchen::find($value);
    
            if ($kitchen && $kitchen->restaurant) {
                // جلب المستودعات المرتبطة بالمطعم
                $this->warehouses = $kitchen->restaurant->warehouses->toArray() ?? collect(); // تأكد من تحويلها إلى مصفوفة
            }
        }
    }
    
    

    protected $listeners = ['orderUpdate'];
    public function orderUpdate($id)
    {
        $this->order = Order::find($id);
        
        if (!$this->order) {
            showAlert($this, 'error', 'order not found');
            return;
        }
    
        $this->restaurants = Restaurant::with(['kitchens', 'warehouses'])->get() ?? collect();
    
        // تحديث القيم بناءً على الطلب المحدد
        $this->code          = $this->order->code;
        $this->kitchen_id    = $this->order->kitchen_id;
        $this->warehouse_id  = $this->order->warehouse_id;
        $this->request_date  = $this->order->request_date;
        $this->notes         = $this->order->notes;
    
        // تحديث قائمة المستودعات بناءً على المطبخ
        $this->warehouses = $this->getWarehousesForKitchen($this->kitchen_id);
    
        // إعادة تعيين التحقق من الأخطاء
        $this->resetValidation();
        $this->resetErrorBag();
    
        // فتح المودال
        $this->dispatch('editOrderModalToggle');
    }
    

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
        $this->restaurants = Restaurant::with(['kitchens', 'warehouses'])->get() ?? collect();

        // تأكد من أن $warehouses ليس null بل مصفوفة فارغة
        $this->warehouses = [];
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
            $this->dispatch('productRefreshComponent');

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
        // $restaurants = Restaurant::with(['creator', 'editor', 'manager', 'kitchens', 'warehouses'])->get();

        // $kitchens = Kitchen::select('id', 'name')->get();
        // $warehouses = Warehouse::select('id', 'name')->get();
        return view('admin.pages.orders.partials.edit', [
            // 'restaurants' => $restaurants,

            // 'kitchens' => $kitchens,
            // 'warehouses' => $warehouses,
        ]);

    }
}
