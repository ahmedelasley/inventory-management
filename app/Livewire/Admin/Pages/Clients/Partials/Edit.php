<?php

namespace App\Livewire\Admin\Pages\Clients\Partials;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Client;
use App\Http\Requests\ClientRequest;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Clients\GetData;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use LivewireAlert;

    public $client;
    public $name, $phone, $email, $address; 

    protected $listeners = ['clientUpdate'];

    public function clientUpdate($id)
    {
        $this->client = Client::find($id);
    
        if (!$this->client) {
            // Alert 
            showAlert($this, 'error', 'Client not found');
        }
    
        // Set the properties
        $this->name = $this->client->name;
        $this->phone = $this->client->phone;
        $this->email = $this->client->email;
        $this->address = $this->client->address;
    
    
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
        return (new ClientRequest('PUT', $this->client->id))->rules();
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

            $this->client->update($validatedData);

            // Add updater
            $service = Admin::find(Auth::guard('admin')->user()->id);
            $this->client->editor()->associate($service);
            $this->client->save(); 
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
        return view('admin.pages.clients.partials.edit');
    }
}
