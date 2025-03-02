<?php

namespace App\Http\Controllers\Keeper;
use App\Http\Controllers\Controller;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('keeper.pages.suppliers.index');
    }


}
