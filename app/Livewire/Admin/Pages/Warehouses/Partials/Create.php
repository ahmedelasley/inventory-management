<?php

namespace App\Livewire\Admin\Pages\Warehouses\Partials;

use Livewire\Component;
use App\Models\Restaurant;
use App\Models\Keeper;
use App\Models\Warehouse;
use App\Livewire\Admin\Pages\Warehouses\GetData;
use App\Http\Requests\WarehouseRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use LivewireAlert;

    public $name;
    public $code;
    public $location;
    public $restaurant_id;
    public $keeper_id;

    protected function rules(): array 
    {
        return (new WarehouseRequest())->rules();
    } 
 
    public function updated($field)
    {
        $this->validateOnly($field);
        // dd($this->validateOnly($field));

    }

    
    public function submit()
    {


        DB::beginTransaction();

        try {
            // dd(str_replace('kit-', '', Warehouse::latest()->first()->code));
            // Check of Validation
            $validatedData       = $this->validate();
            // Add creator
            $validatedData['code'] = 'W-' . ( Warehouse::count() == 0 ? getSetting('warehouse_code') + 1 : (int) str_replace('W-', '', Warehouse::latest()->first()->code) + 1 );
            $validatedData['created_id'] = Auth::guard('admin')->user()->id;
            // Query Create
            Warehouse::create($validatedData);

            $this->reset();

            // Hide modal
            $this->dispatch('close-modal');

            // Refresh skills data component
            $this->dispatch('refreshData')->to(GetData::class);
            // $this->dispatch('refreshForm')->to(Create::class);
            
            // Alert 
            showAlert($this, 'success', __('Done Added Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction            
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
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

        $dataRestaurant = Restaurant::with(['creator', 'editor', 'user', 'kitchens'])->get();
        $dataKeeper = Keeper::with(['creator', 'updater', 'warehouse'])->doesntHave('warehouse')->get();
        return view('admin.pages.warehouses.partials.create', [
            'dataRestaurant' => $dataRestaurant,
            'dataKeeper' => $dataKeeper,
        ]);
    }
}
