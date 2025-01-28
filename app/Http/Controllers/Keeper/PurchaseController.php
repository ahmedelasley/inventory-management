<?php

namespace App\Http\Controllers\Keeper;
use App\Http\Controllers\Controller;

use App\Models\Purchase;
use App\Models\Product;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('keeper.pages.purchases.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPurchase(Purchase $purchase)
    {
        $products = Product::with(['creator', 'updater', 'category'])->paginate(30);
        return view('keeper.pages.purchases.create-purchase', [
            'purchase' => $purchase,
            'products' => $products,
        ]);

    }
    
    /**
     * Store a newly print resource in storage.
     */
    public function printPurchase(Purchase $purchase)
    {
        return view('keeper.pages.purchases.print-purchase', [
            'purchase' => $purchase,
        ]);
    }


}
