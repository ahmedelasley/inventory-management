<?php

namespace App\Http\Controllers\Keeper;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('keeper.dashboard.index');
    }

}
