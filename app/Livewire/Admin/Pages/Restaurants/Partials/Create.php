<?php

namespace App\Livewire\Admin\Pages\Restaurants\Partials;

use Livewire\Component;
use App\Models\User;
use App\Models\Restaurant;
use App\Livewire\Admin\Pages\Restaurants\GetData;
use App\Http\Requests\RestaurantRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use LivewireAlert;

    public $name;
    public $code;
    public $location;
    public $user_id;

    protected function rules(): array 
    {
        return (new RestaurantRequest())->rules();
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
            // dd(str_replace('kit-', '', restaurant::latest()->first()->code));
            // Check of Validation
            $validatedData       = $this->validate();
            // Add creator
            $validatedData['code'] = 'R-' . ( Restaurant::count() == 0 ? getSetting('restaurant_code') + 1 : (int) str_replace('R-', '', Restaurant::latest()->first()->code) + 1 );
            $validatedData['created_id'] = Auth::guard('admin')->user()->id;
            // Query Create
            Restaurant::create($validatedData);

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
        $data = User::with(['restaurant'])->doesntHave('restaurant')->get();
        return view('admin.pages.restaurants.partials.create', [
            'data' => $data,
        ]);
    }
}
