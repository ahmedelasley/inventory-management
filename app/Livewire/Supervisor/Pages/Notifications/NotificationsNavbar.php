<?php

namespace App\Livewire\Supervisor\Pages\Notifications;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;


class NotificationsNavbar extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        return view('supervisor.pages.notifications.notifications-navbar');
    }
}
