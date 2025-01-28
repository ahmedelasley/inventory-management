<?php

namespace App\Http\Controllers\Keeper;
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
        // $data = Warehouse::with(['creator', 'updater', 'keeper'])->paginate(20);
        // return view('keeper.pages.warehouses.index', [
        //     'data' => $data,
        // ]);
        return view('keeper.pages.inventory.index');

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
    // public function store(StoreCategoryRequest $request)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $validated = $request->validated();
    //         $validated['created_id'] = Auth::guard('keeper')->user()->id;
    //         dump($validated['created_id']);
    //         Category::create($validated);

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Created Category!','success')->timerProgressBar();
            
    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('keeper.categories.index')->with('status', 'Created');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        return view('keeper.pages.inventory.show', [
            'data' => $warehouse,
        ]);

    }

        /**
     * Display the specified resource.
     */
    public function showTransaction(WarehouseStock $warehouse_stock)
    {
        return view('keeper.pages.inventory.show-transaction', [
            'data' => $warehouse_stock,
        ]);

    }

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
    //         $validated['updated_id'] = Auth::guard('keeper')->user()->id;

    //         $category->update($validated);

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Updated Category!','success')->timerProgressBar();
            
    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('keeper.categories.index')->with('status', 'Updated');
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
    //     return Redirect::route('keeper.categories.index')->with('status', 'Deleted');
    // }
}
