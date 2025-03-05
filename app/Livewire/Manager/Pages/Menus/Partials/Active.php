<?php

namespace App\Livewire\Manager\Pages\Menus\Partials;

use Livewire\Component;
use App\Models\Menu;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Livewire\Manager\Pages\Menus\GetShow;

class Active extends Component
{
    use LivewireAlert;

    public $menu;
    public $name;

    protected $listeners = [
        'active' => 'active', // Listener for the 'active' event
    ];

    // عند تفعيل أو إلغاء تفعيل العنصر
    public function active($id)
    {
        $this->menu = Menu::find($id);
        $this->name = $this->menu->name;

        // فتح النافذة المنبثقة (modal)
        $this->dispatch('activeModalToggle');
    }

    public function closeForm()
    {
        // إغلاق النافذة المنبثقة (modal)
        $this->dispatch('activeModalToggle');
    }

    // عملية التحديث
    public function submit()
    {
        DB::beginTransaction();

        try {
            // تغيير حالة النشاط (التفعيل أو الإلغاء)
            $this->menu->is_active = $this->menu->is_active == 1 ? 0 : 1;
            $this->menu->save();

            // إغلاق النافذة المنبثقة
            $this->dispatch('activeModalToggle');

            // تحديث المكون نفسه (أو مكونات أخرى إذا لزم الأمر)
            // $this->dispatch('refreshActive'); // يتم تحديث نفس المكون هنا
            $this->dispatch('refreshActive');

            // إشعار النجاح
            showAlert($this, 'success', __('Done Updated Data Successfully'));

            DB::commit(); // نجاح العملية، إجراء التزام

        } catch (Exception $e) {
            DB::rollBack(); // في حال حدوث خطأ، نقوم بالتراجع عن العملية

            // إشعار بالخطأ
            showAlert($this, 'error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('manager.pages.menus.partials.active');
    }
}

