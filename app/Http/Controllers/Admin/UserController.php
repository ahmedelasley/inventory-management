<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::select(['id', 'name', 'email', 'email_verified_at', 'created_at'])->paginate(20);
        return view('admin.pages.users.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();

        try {
            $request->validated();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('password'),
            ]);

            DB::commit(); // All database operations are successful, commit the transaction
            toast('Success Created User!','success')->timerProgressBar();
            
        } catch (Exception $e) {
            DB::rollBack(); // Something went wrong, roll back the transaction
            toast($e->getMessage(),'error')->timerProgressBar();
        }
        return Redirect::route('admin.users.index')->with('status', 'Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();

            $user->fill($validated);

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            DB::commit(); // All database operations are successful, commit the transaction
            toast('Success Updated User!','success')->timerProgressBar();

        } catch (Exception $e) {
            DB::rollBack(); // Something went wrong, roll back the transaction
            toast($e->getMessage(),'error')->timerProgressBar();
        }
        return Redirect::route('admin.users.index')->with('status', 'Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();

        try {
            $user->delete();

            DB::commit(); // All database operations are successful, commit the transaction
            toast('Success Deleted User!','success');

        } catch (Exception $e) {
            DB::rollBack(); // Something went wrong, roll back the transaction
            toast($e->getMessage(),'error')->timerProgressBar();
        }
        return Redirect::route('admin.users.index')->with('status', 'Deleted');

    }

    /**
     * Verify the specified resource from storage.
     */
    public function verify(User $user)
    {
        DB::beginTransaction();

        try {
            $user->email_verified_at = Now();
            $user->save();

            DB::commit(); // All database operations are successful, commit the transaction
            toast('Success Verified User!','success');

        } catch (Exception $e) {
            DB::rollBack(); // Something went wrong, roll back the transaction
            toast($e->getMessage(),'error')->timerProgressBar();
        }
        return Redirect::route('admin.users.index')->with('status', 'Deleted');

    }

}
