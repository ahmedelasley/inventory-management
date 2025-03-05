<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;

use App\Models\Menu;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manager.pages.menus.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('manager.pages.menus.show', [
            'menu' => $menu,
        ]);

    }
}
