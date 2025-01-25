<?php

namespace App\Http\Controllers\Supervisor;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('supervisor.pages.reports.index');
    }

    public function stocks()
    {
        return view('supervisor.pages.reports.stocks');
    }

    public function stocksTransactions()
    {
        return view('supervisor.pages.reports.stocks-transactions');
    }

    public function orders()
    {
        return view('supervisor.pages.reports.orders');
    }

    public function ordersTransactions()
    {
        return view('supervisor.pages.reports.orders-transactions');
    }



}
