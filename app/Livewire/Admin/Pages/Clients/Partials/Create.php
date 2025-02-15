<?php

namespace App\Livewire\Admin\Pages\Clients\Partials;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Client;
use App\Livewire\Admin\Pages\Clients\GetData;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use LivewireAlert;

    public $name, $phone, $email, $address; 

    protected function rules(): array 
    {
        return (new ClientRequest('POST'))->rules();
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
// dd(Client::latest()->first()->code);
            // Add creator
            $validatedData['code'] = 'Cli-' . ( Client::count() == 0 ? getSetting('client_code') + 1 : (int) str_replace('Cli-', '', Client::latest()->first()->code) + 1 );
            // $validatedData['created_id'] = Auth::guard('admin')->user()->id;

            // Query Create
                   // Associate the purchase with the admin user
                   $service = Admin::find(Auth::guard('admin')->user()->id);
                   // Create the purchase record
                   $client = new Client($validatedData);
                   if ($service) {
                       $client->creator()->associate($service);
                   }
                   $client->save();
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

    public function render()
    {
        // $data = Clients::with(['parent', 'children'])->paginate(20);
        return view('admin.pages.clients.partials.create');
    }
}
