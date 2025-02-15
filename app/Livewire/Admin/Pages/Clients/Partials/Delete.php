<?php

namespace App\Livewire\Admin\Pages\Clients\Partials;

use Livewire\Component;
use App\Models\Client;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Pages\Clients\GetData;

class Delete extends Component
{

    use LivewireAlert;


    public $client;
    public $name;

    protected $listeners = ['clientDelete'];

    public function clientDelete($id)
    {
        $this->client = Client::find($id);
        $this->name = $this->client->name;

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
            $this->client->delete();
            $this->reset();
            // Hide modal
            $this->dispatch('deleteModalToggle');

            // Refresh skills data component
            $this->dispatch(['refreshData'])->to(GetData::class);

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
        return view('admin.pages.clients.partials.delete');
    }
}
