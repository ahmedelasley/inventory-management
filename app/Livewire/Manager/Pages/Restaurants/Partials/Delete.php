<?php

namespace App\Livewire\Manager\Pages\Restaurants\Partials;

use Livewire\Component;
use App\Models\Restaurant;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Livewire\Manager\Pages\Restaurants\GetData;

class Delete extends Component
{

    use LivewireAlert;


    public $restaurant;
    public $name;

    protected $listeners = ['restaurantDelete'];

    public function restaurantDelete($id)
    {
        $this->restaurant = Restaurant::find($id);
        $this->name = $this->restaurant->name;

        $this->dispatch('deleteModalToggle');
    }
    public function closeForm()
    {    
        // Close modal
        $this->dispatch('deleteModalToggle');
    }
    public function submit()
    {
        DB::beginTransaction();

        try {

            // Query Create
            $this->restaurant->delete();
            $this->reset('restaurant');
            // Hide modal
            $this->dispatch('deleteModalToggle');

            // Refresh skills data component
            $this->dispatch(['refreshData'])->to(GetData::class);
            // $this->dispatch('restaurantDelete')->to(GetData::class);

            // Alert 
            showAlert($this, 'success', __('Done Deleted Data Successfully'));

            DB::commit(); // All database operations are successful, commit the transaction            
        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('manager.pages.restaurants.partials.delete');
    }
}
