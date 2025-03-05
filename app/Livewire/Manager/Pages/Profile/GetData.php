<?php

namespace App\Livewire\Manager\Pages\Profile;

use Livewire\Component;
use App\Models\Manager;
use Illuminate\Support\Facades\Auth;


class GetData extends Component
{


public $profile;

    public function mount()
    {
        $this->profile = Manager::find(Auth::guard('manager')->user()->id);
    }
    
    protected $listeners = [
        'refreshData' => '$refresh',
        'profileUpdate' => '$refresh',
    ];


    public function render()
    {
        return view('manager.pages.profile.get-data');
    }
}
