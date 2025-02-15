<?php

namespace App\Livewire\Admin\Pages\Menus\Partials;

use Livewire\Component;
use App\Models\Product;

use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class Title extends Component
{
    use  WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $menu;

    protected $listeners = [
        // 'refreshEdit' => '$refresh',
        'refreshActive' =>'$refresh',
    ];

    public function render()
    {
        return view('admin.pages.menus.partials.title');
    }
}
