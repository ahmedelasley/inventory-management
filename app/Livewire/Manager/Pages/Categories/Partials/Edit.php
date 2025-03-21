<?php

namespace App\Livewire\Manager\Pages\Categories\Partials;

use Livewire\Component;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Livewire\Manager\Pages\Categories\GetData;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use LivewireAlert;

    public $category;
    public $name;
    public $description;
    public $parent_id; 

    public function updatedParentId($value)
{
    $this->parent_id = $value === "" ? null : $value;
}

    protected $listeners = ['categoryUpdate'];

    public function categoryUpdate($id)
    {
        $this->category = Category::find($id);
    
        if (!$this->category) {
            // Alert 
            showAlert($this, 'error', 'Category not found');
        }
    
        // Set the properties
        $this->name = $this->category->name;
        $this->description = $this->category->description;
        $this->parent_id = $this->category->parent_id;
    
    
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
        return [
                    'name' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('categories', 'name')->ignore($this->category),
                    ],
                    'description' => [
                        'required',
                        'string',
                    ],
'parent_id' => [
    'nullable',
    'integer',
    function ($attribute, $value, $fail) {
        if (!is_null($value) && !Category::where('id', $value)->exists()) {
            $fail(__('The selected parent category is invalid.'));
        }
    },
],
                ];
    } 
 
    public function updated($field)
    {
        $this->validateOnly($field);
    }


    public function submit()
    {
        DB::beginTransaction();

        try {
            // dd($this->parent_id);

            // Check of Validation
            $validatedData       = $this->validate();
// dd($validatedData); 
            // Add updater
            $validatedData['updated_id'] = Auth::guard('manager')->user()->id;

            // Query Create
            $this->category->update($validatedData);

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
        $data = Category::with(['parent', 'children'])->paginate(20);

        return view('manager.pages.categories.partials.edit', [
            'data' => $data,
        ]);
    }
}
