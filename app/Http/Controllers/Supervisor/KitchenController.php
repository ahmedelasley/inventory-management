<?php

namespace App\Http\Controllers\Supervisor;
use App\Http\Controllers\Controller;

use App\Models\Kitchen;
use App\Models\KitchenStock;
use App\Http\Requests\StoreKitchenRequest;
use App\Http\Requests\UpdateKitchenRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class KitchenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Auth::guard('supervisor')->user()->kitchen->id);
        $data = KitchenStock::with(['createable', 'product', 'kitchen', 'movements'])->where('kitchen_id', Auth::guard('supervisor')->user()->kitchen->id)->paginate(20);
        return view('supervisor.pages.kitchens.index');

    }

    // public function show(Kitchen $kitchen)
    // {
    //     return view('supervisor.pages.kitchens.show', [
    //         'data' => $kitchen,
    //     ]);

    // }

    /**
     * Display the specified resource.
     */
    public function showTransaction(KitchenStock $kitchen_stock)
    {
        return view('supervisor.pages.kitchens.show-transaction', [
            'data' => $kitchen_stock,
        ]);

    }

}
