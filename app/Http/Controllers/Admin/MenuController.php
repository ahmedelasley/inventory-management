<?php

namespace App\Http\Controllers\Admin;
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
        return view('admin.pages.menus.index');
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreProductRequest $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('admin.pages.menus.show', [
            'menu' => $menu,
        ]);

    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Product $product)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateProductRequest $request, Product $product)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Product $product)
    // {
    //     //
    // }
}
