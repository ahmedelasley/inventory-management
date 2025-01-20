<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Purchase::with(['creator', 'updater', 'keeper'])->paginate(20);
        // return view('admin.pages.purchases.index', [
        //     'data' => $data,
        // ]);
        return view('admin.pages.purchases.index');

    }


    public function completeCreate(Purchase $purchase)
    {
        return view('admin.pages.purchases.complete-create', [
            'purchase' => $purchase,
        ]);

    }


    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('admin.pages.purchases.complete-create');

    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StorePurchaseRequest $request)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $validated = $request->validated();
    //         $validated['created_id'] = Auth::guard('admin')->user()->id;
    //         dump($validated['created_id']);
    //         purchase::create($validated);

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Created purchase!','success')->timerProgressBar();
            
    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.categories.index')->with('status', 'Created');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Purchase $purchase)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Purchase $purchase)
    // {
    //     return view('admin.pages.purchases.complete-create', [
    //         'id' => $purchase,
    //     ]);

    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdatePurchaseRequest $request, purchase $Purchase)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $validated = $request->validated();
    //         $validated['updated_id'] = Auth::guard('admin')->user()->id;

    //         $purchase->update($validated);

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Updated purchase!','success')->timerProgressBar();
            
    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.categories.index')->with('status', 'Updated');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Purchase $purchase)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $purchase->delete();

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Deleted Purchase!','success');

    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.categories.index')->with('status', 'Deleted');
    // }
}
