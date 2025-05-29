<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\settingsLdap;

class SettingLdapController extends Controller
{
    //
    public function index()
    {
        $settings = settingsLdap::first();
        //dd($settings);
        return view('backend.settings_ldap.index', compact('settings'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        //dd($request->all());
        $request->validate([
            'LDAP_HOST' => 'required|string|max:255',
            'ldap_port' => 'required|integer',
            'ldap_base_dn' => 'required|string|max:255',
            'ldap_username' => 'required|string|max:255',
            'ldap_password' => 'required|string|max:255',
        ]);

        // Update LDAP settings in the configuration file or database
        $setting = settingsLdap::find($id);
        $setting->LDAP_HOST = $request->input('LDAP_HOST');
        $setting->LDAP_CONNECTION = $request->input('LDAP_CONNECTION');
        $setting->LDAP_PORT = $request->input('LDAP_PORT');
        $setting->LDAP_BASE_DN = $request->input('LDAP_BASE_DN');
        $setting->LDAP_PASSWORD = $request->input('LDAP_PASSWORD');
        $setting->LDAP_USERNAME = $request->input('LDAP_USERNAME');
        $setting->LDAP_USE_SSL = $request->input('LDAP_USE_SSL');
        $setting->LDAP_USE_TLS = $request->input('LDAP_USE_TLS');
        $setting->LDAP_TIMEOUT = $request->input('LDAP_TIMEOUT'); // Default to 30 seconds if not provided
        $setting->LDAP_LOGGING = $request->input('LDAP_LOGGING'); // Default to false if not provided
        // Save the settings to the database
        $setting->save();
        $alert = [
            'message' => 'LDAP settings updated successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($alert);
    }
}
