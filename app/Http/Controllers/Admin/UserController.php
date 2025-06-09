<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct() {
        $this->middleware("permission:usersap index")->only(['index']);

    }

    public function index()
    {
        // Logic to retrieve and display users
        $users= \App\Models\User::all(); // Assuming you have a User model
        return view('backend.users.index',compact('users'));
    }
}
