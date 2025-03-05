<?php

namespace App\Livewire\Manager\Pages\Menus\Partials;

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
        return view('manager.pages.menus.partials.show-information');
    }
}
