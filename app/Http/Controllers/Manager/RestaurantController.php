<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manager.pages.restaurants.index');
    }


    public function show(Restaurant $restaurant)
    {
        return view('manager.pages.restaurants.show', [
            'data' => $restaurant,
        ]);

    }
}
