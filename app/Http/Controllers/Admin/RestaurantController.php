<?php

namespace App\Http\Controllers\Admin;
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
        return view('admin.pages.restaurants.index');
    }


    public function show(Restaurant $restaurant)
    {
        return view('admin.pages.restaurants.show', [
            'data' => $restaurant,
        ]);

    }

    //     /**
    //  * Display the specified resource.
    //  */
    // public function showTransaction(KitchenStock $kitchen_stock)
    // {
    //     return view('admin.pages.kitchens.show-transaction', [
    //         'data' => $kitchen_stock,
    //     ]);

    // }




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
    // public function store(StoreCategoryRequest $request)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $validated = $request->validated();
    //         $validated['created_id'] = Auth::guard('admin')->user()->id;
    //         dump($validated['created_id']);
    //         Category::create($validated);

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Created Category!','success')->timerProgressBar();
            
    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.categories.index')->with('status', 'Created');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Category $category)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Category $category)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateCategoryRequest $request, Category $category)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $validated = $request->validated();
    //         $validated['updated_id'] = Auth::guard('admin')->user()->id;

    //         $category->update($validated);

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Updated Category!','success')->timerProgressBar();
            
    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.categories.index')->with('status', 'Updated');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Category $category)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $category->delete();

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Deleted Category!','success');

    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.categories.index')->with('status', 'Deleted');
    // }
}
