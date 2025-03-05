<?php

namespace App\Livewire\Manager\Pages\Menus\Partials;

use Livewire\Component;
use App\Models\Menu;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowIngredients extends Component
{
    public $menu;
    protected $listeners = [
        'refreshAddItem' => '$refresh',
    ];
    public function render()
    {
        return view('manager.pages.menus.partials.show-ingredients');
    }
}
