<?php

namespace App\Livewire\Admin\Dashboard\Partials\Statiscs;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;


class CardStatiscs extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        return view('admin.dashboard.partials.statiscs.card-statiscs');
    }
}
