<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function readAll()
    {

        $user = Auth::guard('manager')->user();
        if($user) {
            $user->unreadNotifications->markAsRead();
        }

        return redirect()->back()->with('success', 'All notifications marked as read');
    }



}
