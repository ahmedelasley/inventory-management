<?php

namespace App\Livewire\Manager\Pages\Categories\Partials;

use Livewire\Component;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Livewire\Manager\Pages\Categories\GetData;

class Delete extends Component
{

    use LivewireAlert;


    public $category;
    public $name;

    protected $listeners = ['categoryDelete'];

    public function categoryDelete($id)
    {
        $this->category = Category::find($id);
        $this->name = $this->category->name;

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
            $this->category->delete();
            $this->reset('category');
            // Hide modal
            $this->dispatch('deleteModalToggle');

            // Refresh skills data component
            $this->dispatch(['refreshData'])->to(GetData::class);
            // $this->dispatch('categoryDelete')->to(GetData::class);

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
        return view('manager.pages.categories.partials.delete');
    }
}
