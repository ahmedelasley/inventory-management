<?php

namespace App\Livewire\Admin\Pages\Profile;

use Livewire\Component;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;


class GetData extends Component
{


public $profile;

    public function mount()
    {
        $this->profile = Admin::find(Auth::guard('admin')->user()->id);
    }
    
    protected $listeners = [
        'refreshData' => '$refresh',
        'profileUpdate' => '$refresh',
    ];


    public function render()
    {
        return view('admin.pages.profile.get-data');
    }
}
