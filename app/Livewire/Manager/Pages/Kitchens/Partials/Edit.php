<?php

namespace App\Livewire\Manager\Pages\Kitchens\Partials;

use Livewire\Component;
use App\Models\Restaurant;
use App\Models\Supervisor;
use App\Models\Kitchen;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use App\Http\Requests\KitchenRequest;

use Illuminate\Support\Facades\DB;
use App\Livewire\Manager\Pages\Kitchens\GetData;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use LivewireAlert;

    public $kitchen;
    
    public $name;
    public $code;
    public $location;
    public $restaurant_id;
    public $supervisor_id;

    protected $listeners = ['kitchenUpdate'];

    public function kitchenUpdate($id)
    {
        $this->kitchen = Kitchen::find($id);
    
        if (!$this->kitchen) {
            // Alert 
            showAlert($this, 'error', 'Kitchen not found');
        }
    
        // Set the properties
        $this->name            = $this->kitchen->name;
        $this->code            = $this->kitchen->code;
        $this->location        = $this->kitchen->location;
        $this->restaurant_id   = $this->kitchen->restaurant_id;
        $this->supervisor_id   = $this->kitchen->supervisor_id;
    
    
        // Reset validation and errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Open modal
        $this->dispatch('editModalToggle');
    }

    public function closeForm()
    {
        // Reset form fields
        $this->reset();
    
        // Reset validation errors
        $this->resetValidation();
        $this->resetErrorBag();
    
        // Close modal
        $this->dispatch('editModalToggle');
    }
    
    public function rules()
    {
        return (new KitchenRequest('PUT', $this->kitchen->id))->rules();
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
            $validatedData['updated_id'] = Auth::guard('manager')->user()->id;

            // Query Create
            $this->kitchen->update($validatedData);

            $this->reset();

            // Hide modal
            $this->dispatch('editModalToggle');

            // Refresh skills data component
            $this->dispatch('refreshData')->to(GetData::class);
            
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

        $dataRestaurant = Restaurant::with(['creator', 'editor', 'manager'])->get();
        $dataSupervisor = Supervisor::with(['creator', 'updater', 'kitchen'])->doesntHave('kitchen')->get();
        return view('manager.pages.kitchens.partials.edit', [
            'dataRestaurant' => $dataRestaurant,
            'dataSupervisor' => $dataSupervisor,
        ]);
    }
}
