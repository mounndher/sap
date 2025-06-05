<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// package imports for roles and permissions
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermisionController extends Controller
{
    //
    public function index()
    {
        // Logic to display roles and permissions
        $roles = Role::all(); // Get all roles
        return view('backend.role.index',compact('roles'));
    }
    public function create1()
    {

        // how to use   role and permission in laravel test
        //creatze a new role
        // $role = Role::create(['name' => 'writer']);
        //display the created role
        //dd($role);
        // now i use web guard data in my dtabase
        // INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES(1, 'writer', 'web', '2025-06-04 09:06:59', '2025-06-04 09:06:59');
        ///if chose  guard admin
        //$role = Role::create(['name' => 'writer', 'guard_name' => 'admin']);
        //dd($role);
        // create a new permission
        //$permission = Permission::create(['name' => 'edit index']);
        // dd($permission);
        //Auth::user()->assignRole('writer'); // assign the role to the authenticated user
        // get the names of the user's roles
        // $roles = Auth::user()->getRoleNames(); // returns a collection of role names
        //dd($roles); // ['writer']
        // add this blade for test
        // dispary the articles  form  sidebar
        // @if(auth()->user()->hasPermissionTo('edit index'))




        // Auth::user()->givePermissionTo('edit index'); // assign permission to the user

        // Auth::user()->syncRoles(['writer', 'editor']); // sync roles for the user



        // $role =Role::find(3);
        //dd($role);
        // $role->givePermissionTo('edit index'); // assign permission to the role

        // and u can add role and permission in the database with artisan command
        // php artisan permission:create-role writer
        // php artisan permission:create-permission edit index
        // php artisan permission:assign-role writer
        // php artisan permission:assign-permission edit index




    }

    public function create()
    {
        // Logic to show form for creating a new role
        $permissions = Permission::all()->groupBy('group_name'); // Get all permissions
        //dd($permissions); // Debugging line to check permissions
        return view('backend.role.create', compact('permissions'));
    }
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'role' => ['required', 'string', 'max:50', 'unique:roles,name'],

        ]);

        // Create the role
        $role = Role::create([
            'guard_name' => 'web',
            'name' => $validated['role']
        ]);

        // Sync permissions if any were provided

      $role->syncPermissions($request->permissions ?? []); // Sync permissions with the role



        return redirect()->route('roles.index')->with(
            [
             'message' => 'Role created successfully.',
            'alert-type' => 'success',
        ]
        );
    }
    public function edit($id)
    {
        // Logic to show form for editing a role
        $role = Role::findOrFail($id); // Find the role by ID
        $permissions = Permission::all()->groupBy('group_name'); // Get all permissions
        $rolePermissions = $role->permissions->pluck('name')->toArray(); // Get permissions assigned to the role

        return view('backend.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }


    public function update(Request $request, $id)
{
    // Validate the request
    $validated = $request->validate([
        'role' => ['required', 'string', 'max:50', 'unique:roles,name,'.$id],

    ]);

    // Find the role
    $role = Role::findOrFail($id);

    // Update the role
    $role->update([
        'guard_name' => 'web',
        'name' => $validated['role']
    ]);

    // Sync permissions with the role
    $role->syncPermissions($request->permissions ?? []);

    return redirect()->route('roles.index')->with([
        'message' => 'Role updated successfully.',
        'alert-type' => 'success',
    ]);
}
public function destroy($id)
{
    // Logic to delete a role
    $role = Role::findOrFail($id); // Find the role by ID
    $role->delete(); // Delete the role

    return response([
        'message' => 'Role deleted successfully.',
        'alert-type' => 'success',
    ]);
}
}
