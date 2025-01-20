<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Category::with(['parent', 'children'])->paginate(20);
        // return view('admin.pages.categories.index', [
        //     'data' => $data,
        // ]);
        return view('admin.pages.categories.index');

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
