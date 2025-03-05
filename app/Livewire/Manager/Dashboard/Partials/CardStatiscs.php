<?php

namespace App\Livewire\Manager\Dashboard\Partials;

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
        return view('manager.dashboard.partials.card-statiscs');
    }
}
