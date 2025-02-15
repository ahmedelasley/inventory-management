<?php

namespace App\Livewire\Admin\Pages\Clients\Partials;

use Livewire\Component;
use App\Models\Client;

class Show extends Component
{

    public $client;
    
    public $name;
    public $code;
    public $phone;
    public $email;
    public $address;
    
    protected $listeners = ['clientShow'];

    public function clientShow($id)
    {
        $this->client = Client::find($id);
    
        if (!$this->client) {
            // Alert 
            showAlert($this, 'error', 'Client not found');
        }
    
        // Set the properties
        $this->name     = $this->client->name;
        $this->code     = $this->client->code;
        $this->phone    = $this->client->phone;
        $this->email    = $this->client->email;
        $this->address  = $this->client->address;

        // Open modal
        $this->dispatch('showModalToggle');
    }

    public function closeForm()
    {   
        // Close modal
        $this->dispatch('showModalToggle');
    }
    
    public function render()
    {

        return view('admin.pages.clients.partials.show');
    }
}
