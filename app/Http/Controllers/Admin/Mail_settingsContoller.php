<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mail_settings;

class Mail_settingsContoller extends Controller
{
    //
    public function __construct() {
        $this->middleware("permission:Smtp index")->only(['index']);
        $this->middleware("permission:Smtp update")->only(['update']);
    }
    public function index()
    {
        $mailSettings = Mail_settings::first();
        return view('backend.mail_settings.index',compact('mailSettings'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'mail_mailer' => 'required|string',
            'mail_host' => 'nullable|string',
            'mail_port' => 'nullable|integer',
            'mail_username' => 'nullable|string',
            'mail_password' => 'nullable|string',
            'mail_encryption' => 'nullable|string',
            'mail_from_address' => 'nullable|email',
            'mail_from_name' => 'nullable|string',
        ]);

        // Update the mail settings in the database
        $mailSettings = Mail_settings::findOrFail($id);
        $mailSettings->update($request->all());


        return redirect()->route('mail_settings.index')->with([
             'message' => 'Mail settings updated successfully.',
            'alert-type' => 'success',
        ]);
    }
}
