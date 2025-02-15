<?php

namespace App\Livewire\Admin\Pages\Menus\Partials;

use Livewire\Component;
use App\Models\Menu;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowInformation extends Component
{
    public $menu;
    protected $listeners = [
        // 'refreshAddItem' => '$refresh',
        'refreshEdit' => '$refresh',
    ];
    public function render()
    {
        return view('admin.pages.menus.partials.show-information');
    }
}
