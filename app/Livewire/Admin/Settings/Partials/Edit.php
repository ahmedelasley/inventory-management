<?php

namespace App\Livewire\Admin\Settings\Partials;

use Livewire\Component;
use App\Models\Setting;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Settings\GetData;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;

class Edit extends Component
{
    use LivewireAlert;

    
    public $settings = [];
    public $data_types = [];
    public $type = [];

    public $validationRules = [];



    public function mount()
    {
        // Load settings into the component
        $this->settings = Setting::all()->pluck('value', 'key')->toArray();
        $this->data_types = Setting::all()->pluck('data_type', 'key')->toArray(); // افتراض أن لديك عمود "type"
        $this->type = Setting::all()->pluck('type', 'key')->toArray(); // افتراض أن لديك عمود "type"

        // Dynamically define validation rules
        $this->generateValidationRules();
    }


    private function generateValidationRules()
    {
        // Define default rules for each setting key

        foreach ($this->data_types as $key => $dataType) {
            // if ($dataType === 'file') {
            //     $this->validationRules["settings.$key"] = 'nullable|file|mimes:jpg,png,jpeg,gif,svg|max:2048';
            // } else {
                $this->validationRules["settings.$key"] = 'nullable|string|max:255';
            // }
        }
    }

    public function updated($propertyName)
    {
        // Validate the updated field dynamically
        $this->validateOnly($propertyName, $this->validationRules);
    }

    public function submit()
    {
        DB::beginTransaction();

        try {
            // dump(1);

            // Validate all fields dynamically
            $this->validate($this->validationRules);
            // dump(1);

            // Save the updated settings
            foreach ($this->settings as $key => $value) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            // Reset validation errors
            $this->resetValidation();
            $this->resetErrorBag();

            // if (Cache::has('app_settings')) {
            //     Cache::forget('app_settings');
            // }

            // Cache::rememberForever('app_settings', function () {
            //     return Setting::pluck('value', 'key')->toArray();

            // });

            // Cache::forever('app_settings', Setting::pluck('value', 'key')->toArray());
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
        return view('admin.settings.partials.edit');
    }
}
