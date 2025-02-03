<?php

namespace App\Livewire\Keeper\Pages\Profile;

use Livewire\Component;
use App\Models\Keeper;
use Illuminate\Support\Facades\Auth;


class GetData extends Component
{


public $profile;

    public function mount()
    {
        $this->profile = Keeper::find(Auth::guard('keeper')->user()->id);
    }
    
    protected $listeners = [
        'refreshData' => '$refresh',
        'profileUpdate' => '$refresh',
    ];


    public function render()
    {
        return view('keeper.pages.profile.get-data');
    }
}
