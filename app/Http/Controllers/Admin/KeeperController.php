<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keeper;
use App\Http\Requests\KeeperRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;

class KeeperController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Keeper::select(['id', 'name', 'email', 'email_verified_at', 'created_at'])->paginate(20);
        // return view('admin.pages.keepers.index', [
        //     'data' => $data,
        // ]);
        return view('admin.pages.keepers.index');

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
    // public function store(KeeperRequest $request)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $request->validated();

    //         Keeper::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => Hash::make('password'),
    //         ]);

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Created Keeper!','success')->timerProgressBar();
            
    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.Keepers.index')->with('status', 'Created');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Keeper $Keeper)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Keeper $Keeper)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(KeeperRequest $request, Keeper $Keeper)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $validated = $request->validated();

    //         $Keeper->fill($validated);

    //         if ($Keeper->isDirty('email')) {
    //             $Keeper->email_verified_at = null;
    //         }

    //         $Keeper->save();

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Updated Keeper!','success')->timerProgressBar();

    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.Keepers.index')->with('status', 'Updated');

    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Keeper $Keeper)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $Keeper->delete();

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Deleted Keeper!','success');

    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.Keepers.index')->with('status', 'Deleted');

    // }

    // /**
    //  * Verify the specified resource from storage.
    //  */
    // public function verify(Keeper $Keeper)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $Keeper->email_verified_at = Now();
    //         $Keeper->save();

    //         DB::commit(); // All database operations are successful, commit the transaction
    //         toast('Success Verified Keeper!','success');

    //     } catch (Exception $e) {
    //         DB::rollBack(); // Something went wrong, roll back the transaction
    //         toast($e->getMessage(),'error')->timerProgressBar();
    //     }
    //     return Redirect::route('admin.Keepers.index')->with('status', 'Deleted');

    // }

}
