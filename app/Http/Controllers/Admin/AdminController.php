<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Admin::select(['id', 'name', 'email', 'email_verified_at', 'created_at'])->paginate(20);
        // $roles = Role::where('guard_name', 'admin')->get();
        // return view('admin.pages.admins.index', [
        //     'data' => $data,
        //     'roles' => $roles,
        // ]);
        return view('admin.pages.admins.index');
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
    // public function store(StoreAdminRequest $request)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $validated = $request->validated();

    //         // Step 1: Create a new Admin
    //         $admin = Admin::create([
    //             'name' => $validated['name'],
    //             'email' => $validated['email'],
    //             'password' => bcrypt('password'),
    //         ]);

    //         // Step 2: Assign Role for Admin
    //         if(isset($validated['role'])) $admin->assignRole($validated['role']);


    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Created Admin!','success')->timerProgressBar();

    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }

    //     return Redirect::route('admin.admins.index')->with('status', 'Created');

    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Admin $admin)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Admin $admin)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateAdminRequest $request, Admin $admin)
    // {
    //     DB::beginTransaction();

    //     try {

    //         $validated = $request->validated();

    //         // Step 1: Update a Admin
    //         $admin->fill($validated);

    //         // Step 2: Check verified Admin
    //         if ($admin->isDirty('email')) {
    //             $admin->email_verified_at = null;
    //         }

    //         // Step 3: Sync Role for Admin
    //         $admin->syncRoles();

    //         // Step 4: Assign Role for Admin
    //         if(isset($validated['role'])) $admin->assignRole($validated['role']);
            
    //         $admin->save();

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Updated Admin!','success')->timerProgressBar();
            
    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.admins.index')->with('status', 'Updated');

    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Admin $admin)
    // {
    //     DB::beginTransaction();

    //     try {
    //         // Step 1: Sync Role for Admin
    //         $admin->syncRoles();

    //         // Step 2: Delete Admin
    //         $admin->delete();

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Deleted Admin!','success');

    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.admins.index')->with('status', 'Deleted');

    // }

    // /**
    //  * Verify the specified resource from storage.
    //  */
    // public function verify(Admin $admin)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $admin->email_verified_at = Now();
    //         $admin->save();

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Verified Admin!','success');

    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.admins.index')->with('status', 'Deleted');

    // }

    //   /**
    //  * Verify the specified resource from storage.
    //  */
    // public function assignRole(Request $request, Admin $admin)
    // {
    //     DB::beginTransaction();

    //     try {

    //         $validated = $request->validate([
    //             'role' => 'required', 
    //         ]);
    //         // Step 1: Sync Role for Admin
    //         $admin->syncRoles();

    //         // Step 2: Assign Role for Admin
    //         if(isset($validated['role'])) $admin->assignRole($validated['role']);

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Assigned Role Admin!','success')->timerProgressBar();

    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.admins.index')->with('status', 'Assigned Role');

    // }
}
