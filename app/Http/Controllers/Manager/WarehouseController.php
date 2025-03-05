<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;

use App\Models\Warehouse;
use App\Models\WarehouseStock;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manager.pages.warehouses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        return view('manager.pages.warehouses.show', [
            'data' => $warehouse,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function showTransaction(WarehouseStock $warehouse_stock)
    {
        return view('manager.pages.warehouses.show-transaction', [
            'data' => $warehouse_stock,
        ]);

    }

}
