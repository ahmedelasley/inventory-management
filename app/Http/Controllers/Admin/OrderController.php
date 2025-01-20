<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createOrder(Order $order)
    {
        $products = Product::with(['creator', 'updater', 'category'])->paginate(30);
        return view('admin.pages.orders.create-order', [
            'order' => $order,
            'products' => $products,
        ]);

    }
    
    /**
     * Store a newly print resource in storage.
     */
    public function printOrder(Order $order)
    {
        return view('admin.pages.orders.print-order', [
            'order' => $order,
        ]);
    }


}
