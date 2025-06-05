<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User; // Ensure you import the User model
class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $users= \App\Models\User::all();
        return view('backend.role-users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //
        // $request->validate([
       //     'role' => 'required',

        //]);
        //$user = User::findOrFail($id);
        //$user->name = $request->name;
      //$user->username = $request->username;
        //user->status=1
      //  $user->save();
        //Assign the role to the user
       // $user->assignRole($request->role);
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
        $user = User::findOrFail($id);
        //dd($user->id);
        $roles=Role::all(); // Get all roles
        return view('backend.role-users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
       // dd($request->all());


        $request->validate([
            'role' => 'required',

        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        //user->status=1
        $user->save();
        //Assign the role to the user
       // $user->assignRole($request->role);


       //Replace any existing role with the new one
       $user->syncRoles([$request->role]);
        return redirect()->route('role-users.index')->with([
        'alert-type' => 'success',
            'message' => 'Role created successfully.',

        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id);
        if($user->getRoleNames()->first()!= 'Super Admin') {
            return response()->json(['status' => 'error', 'message' => 'You cannot delete a Super Admin user.']);
        }
        $user->delete();
        return response()->json(['status' => 'success', 'message' => 'User deleted successfully.']);
    }
}
