<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manager.pages.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createOrder(Order $order, Request $request)
    {

        //set order notification to read at this point
        $notification_id = $request->notification_id;
        if ($notification_id) {
            $user = Auth::guard('manager')->user();
            if($user) {
                $notification = $user->unreadNotifications()->find($notification_id);
                if($notification) {
                    $notification->markAsRead();
                }
            }
        }


        $products = Product::with(['creator', 'updater', 'category'])->paginate(30);
        return view('manager.pages.orders.create-order', [
            'order' => $order,
            'products' => $products,
        ]);

    }
    
    /**
     * Store a newly print resource in storage.
     */
    public function printOrder(Order $order)
    {
        return view('manager.pages.orders.print-order', [
            'order' => $order,
        ]);
    }

    public function showTransaction(Order $order)
    {
        return view('manager.pages.orders.show-transaction', [
            'data' => $order,
        ]);
    }

}
