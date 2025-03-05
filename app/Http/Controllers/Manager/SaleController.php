<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;

use App\Models\Sale;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manager.pages.sales.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createSale(Sale $sale, Request $request)
    {

        //set sale notification to read at this point
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


        // $products = Menu::with(['creator', 'editor'])->where('restaurant_id', $sale->restaurant_id )->paginate(30);
        return view('manager.pages.sales.create-sale', [
            'sale' => $sale,
            // 'products' => $products,
        ]);

    }
    
    /**
     * Store a newly print resource in storage.
     */
    public function printSale(Sale $sale)
    {
        return view('manager.pages.sales.print-sale', [
            'sale' => $sale,
        ]);
    }

    public function showTransaction(Sale $sale)
    {
        return view('manager.pages.sales.show-transaction', [
            'data' => $sale,
        ]);
    }
}
