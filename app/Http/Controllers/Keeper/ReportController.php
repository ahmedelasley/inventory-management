<?php

namespace App\Http\Controllers\Keeper;
use App\Http\Controllers\Controller;

use App\Models\OrderStatus;
use App\Models\Order;
use App\Models\KitchenStock;
use App\Models\KitchenStockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('keeper.pages.reports.index');
    }

    public function stocks()
    {
        return view('keeper.pages.reports.stocks');
    }

    public function stocksTransactions()
    {
        return view('keeper.pages.reports.stocks-transactions');
    }

    public function orders()
    {
        return view('keeper.pages.reports.orders');
    }

    public function ordersTransactions()
    {
        return view('keeper.pages.reports.orders-transactions');
    }


    public function printStocks($type, $status, $fromDate, $toDate)
    {
        $data = KitchenStock::with(['createable', 'product', 'kitchen', 'movements']);

        // if ($stocks != 'All') {
        //     $data = $data->whereHas('kitchenStock', function ($query) {
        //         $query->where('product_id', 'like', '%' . $stocks . '%'); 
        //     });
        //  }   
        //  if ($status != 'All') {
        //     $data = $data->where('type', 'like', '%' . $status . '%');
        //  }   
         
        $data = $data->whereBetween('created_at', [$fromDate, $toDate])->latest()->get();


        return view('keeper.pages.reports.print.stocks',[
            "type" => $type,
            "status" => $status,
            "fromDate" => $fromDate,
            "toDate" => $toDate,
            "data" => $data,
        ]);
    }

    public function printStocksTransactions($stocks, $status, $fromDate, $toDate)
    {
        $data = KitchenStockMovement::with(['createable', 'kitchenStock']);

        if ($stocks != 'All') {
            $data = $data->whereHas('kitchenStock', function ($query) {
                $query->where('product_id', 'like', '%' . $stocks . '%'); 
            });
         }   
         if ($status != 'All') {
            $data = $data->where('type', 'like', '%' . $status . '%');
         }   

        $data = $data->whereBetween('created_at', [$fromDate, $toDate])->latest()->get();

        return view('keeper.pages.reports.print.stocks-transactions',[
            "stocks" => $stocks,
            "status" => $status,
            "fromDate" => $fromDate,
            "toDate" => $toDate,
            "data" => $data,
        ]);
    }

    public function printOrders($type, $status, $fromDate, $toDate)
    {

        $data = Order::with(['kitchen', 'warehouse', 'products', 'createable'])->where('kitchen_id', Auth::guard('keeper')->user()->kitchen->id);

        if ($type != 'All') {
            $data = $data->where('type', $type);
         }   
         if ($status != 'All') {
            $data = $data->where('status', $status);
         }   
         
        $data = $data->whereBetween('created_at', [$fromDate, $toDate])->latest()->get();


        return view('keeper.pages.reports.print.orders',[
            "type" => $type,
            "status" => $status,
            "fromDate" => $fromDate,
            "toDate" => $toDate,
            "data" => $data,
        ]);
    }

    public function printOrdersTransactions($order, $oldStatus, $newStatus, $fromDate, $toDate)
    {

        $data = OrderStatus::with(['statusable', 'order'])->whereHas('order', function ($query) {
            $query->where('kitchen_id', Auth::guard('keeper')->user()->kitchen->id); 
        });

        if ($order != 'All') {
        $data = $data->where('order_id', $order);
        }   
        if ($oldStatus != 'All') {
        $data = $data->where('old_status', $oldStatus);
        }   

        if ($newStatus != 'All') {
        $data = $data->where('new_status', $newStatus);
        }   

        $data = $data->whereBetween('created_at', [$fromDate, $toDate])->latest()->get();

        return view('keeper.pages.reports.print.orders-transactions',[
            "order" => $order,
            "oldStatus" => $oldStatus,
            "newStatus" => $newStatus,
            "fromDate" => $fromDate,
            "toDate" => $toDate,
            "data" => $data,
        ]);
    }



}
