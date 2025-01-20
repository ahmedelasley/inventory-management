<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::where('guard_name', 'web')->orderBy('id','DESC')->paginate(50);
        $groups = Permission::where('guard_name', 'web')->get();
        return view('admin.pages.roles.users.index', [
            'data' => $data,
            'groups' => $groups,
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
    public function store(RoleRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            // dd($data);
            $role = Role::create( ['name' => $data['name'], 'guard_name' => 'web' ]);
            if (isset($data['permissionArray'])) {
                foreach ($data['permissionArray'] as $permission => $value) {
                $role->givePermissionTo($permission);
                }
            }

                
            DB::commit(); // All database operations are successful, commit the transaction
            toast('Success Created Admin!','success')->timerProgressBar();

        } catch (Exception $e) {
            DB::rollBack(); // Something went wrong, roll back the transaction
            toast($e->getMessage(),'error')->timerProgressBar();
        }
        return redirect()->route('admin.users-roles.index')->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $users_role)
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();

            $users_role->update(['name' => $data['name']]);
            $users_role->syncPermissions();
            if (isset($data['permissionArray'])) {
                foreach ($data['permissionArray'] as $permission => $value) {
                $users_role->givePermissionTo($permission);
                }
            }   

            DB::commit(); // All database operations are successful, commit the transaction
            toast('Success Updated Role!','success')->timerProgressBar();

        } catch (Exception $e) {
            DB::rollBack(); // Something went wrong, roll back the transaction
            toast($e->getMessage(),'error')->timerProgressBar();
        }
        return redirect()->route('admin.users-roles.index')->with('success','Role Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $users_role)
    {
        DB::beginTransaction();

        try {
            $users_role->delete();

            DB::commit(); // All database operations are successful, commit the transaction
            toast('Success Deleted Role!','success');
            
        } catch (Exception $e) {
            DB::rollBack(); // Something went wrong, roll back the transaction
            toast($e->getMessage(),'error')->timerProgressBar();
        }
        return redirect()->route('admin.users-roles.index')->with('success','Role Deleted successfully');

    }
}
