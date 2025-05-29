<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserSap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
class UserSapController extends Controller
{
    //
      public function index()
    {
        $usersap = UserSap::first();
        //dd($settings);
        return view('backend.usersap.index', compact('usersap'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        //dd($request->all());
        $request->validate([
            'username' => 'required|max:255',
            'password' => 'required|',

        ]);

        // Update LDAP settings in the configuration file or database
        $setting = UserSap::find($id);
        $setting->username = $request->input('username');
        $setting->password = Crypt::encryptString($request->input('password'));
        // Save the settings to the database
        $setting->save();
        $alert = [
            'message' => 'user sap updated successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($alert);
    }
}
