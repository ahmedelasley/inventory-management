<?php

namespace App\Livewire\Admin\Pages\Restaurants\Partials;

use Livewire\Component;
use App\Models\User;
use App\Models\Restaurant;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use App\Http\Requests\RestaurantRequest;

use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Restaurants\GetData;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use LivewireAlert;

    public $restaurant;
    
    public $name;
    public $code;
    public $location;
    public $user_id;

    protected $listeners = ['restaurantUpdate'];

    public function restaurantUpdate($id)
    {
        $this->restaurant = Restaurant::find($id);
    
        if (!$this->restaurant) {
            // Alert 
            showAlert($this, 'error', 'restaurant not found');
        }
    
        // Set the properties
        $this->name            = $this->restaurant->name;
        $this->code            = $this->restaurant->code;
        $this->location        = $this->restaurant->location;
        $this->user_id         = $this->restaurant->user_id;
    
    
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
        return (new RestaurantRequest('PUT', $this->restaurant->id))->rules();
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
            $validatedData['updated_id'] = Auth::guard('admin')->user()->id;

            // Query Create
            $this->restaurant->update($validatedData);

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

        $data = User::with(['restaurant'])->doesntHave('restaurant')->get();
        return view('admin.pages.restaurants.partials.edit', [
            'data' => $data,
        ]);
    }
}
