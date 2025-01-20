<?php

namespace App\Livewire\Admin\Settings\Partials;

use Livewire\Component;
use App\Models\Setting;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class Backup extends Component
{
    use LivewireAlert;

    public function backupProject()
    {
        DB::beginTransaction();

        try {
            Artisan::call('backup:run');
    
            // Alert 
            showAlert($this, 'success', __('Done Added Data Successfully'));
            
            DB::commit(); // All database operations are successful, commit the transaction   

        } catch (Exception $e) {

            DB::rollBack(); // Something went wrong, roll back the transaction

            // Alert 
            showAlert($this, 'error', $e->getMessage());

        }
    }

    public function backupDatabase()
    {
        DB::beginTransaction();

        try {
            Artisan::call('backup:run --only-db');
    
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
        return view('admin.settings.partials.backup');
    }
}
