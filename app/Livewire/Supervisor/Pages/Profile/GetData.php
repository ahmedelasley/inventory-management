<?php

namespace App\Livewire\Supervisor\Pages\Profile;

use Livewire\Component;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Auth;


class GetData extends Component
{


public $profile;

    public function mount()
    {
        $this->profile = Supervisor::find(Auth::guard('supervisor')->user()->id);
    }
    
    protected $listeners = [
        'refreshData' => '$refresh',
        'profileUpdate' => '$refresh',
    ];


    public function render()
    {
        return view('supervisor.pages.profile.get-data');
    }
}
