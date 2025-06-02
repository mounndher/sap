<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mail_recipients;

class Mail_recipientsController extends Controller
{
    //
    public function index()
    {
        // Logic to retrieve and display mail recipients
        $mailRecipients=Mail_recipients::all();
        return view('backend.mail_recipients.index',compact('mailRecipients'));
    }
    public function create()
    {
        // Logic to show form for creating a new mail recipient
        return view('backend.mail_recipients.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mail_recipients,email',
            'status' => 'required',
        ]);
        // Logic to store a new mail recipient
        $mailRecipient = new Mail_recipients();
        $mailRecipient->name = $request->input('name');
        $mailRecipient->email = $request->input('email');
        $mailRecipient->status=$request->input('status');
         $mailRecipient->validtion=$request->input('validtion',0);// Default to 0 if not provided
        $mailRecipient->save();
        // Redirect or return a response
        return redirect()->route('mail_recipients.index')->with('success', 'Mail recipient created successfully.');
    }
    public function edit($id)
    {
        // Logic to show form for editing an existing mail recipient
        // Retrieve the recipient by ID and pass it to the view
        $mailRecipient = Mail_recipients::findOrFail($id);
        if (!$mailRecipient) {
            return redirect()->route('mail_recipients.index')->with('error', 'Mail recipient not found.');
        }
        return view('backend.mail_recipients.edit', compact('mailRecipient'));
    }
    public function update(Request $request, $id)
    {
        // Logic to update an existing mail recipient
        // Validate and update the recipient data
        // Redirect or return a response
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mail_recipients,email,' . $id,
        ]);
        $mailRecipient = Mail_recipients::findOrFail($id);
        if (!$mailRecipient) {
            return redirect()->route('mail_recipients.index')->with('error', 'Mail recipient not found.');
        }
        $mailRecipient->name = $request->input('name');
        $mailRecipient->email = $request->input('email');
        $mailRecipient->status=$request->input('status');
        $mailRecipient->validtion = $request->input('validtion', 0); // Default to 0 if not provided
        $mailRecipient->save();
        return redirect()->route('mail_recipients.index')->with('success', 'Mail recipient updated successfully.');
    }
    public function destroy($id)
    {
        // Logic to delete a mail recipient
        // Find the recipient by ID and delete it
        // Redirect or return a response
        try {
            $mailRecipient = Mail_recipients::findOrFail($id);
            $mailRecipient->delete();
            return response()->json(['status' => 'success', 'message' => 'Mail recipient deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unable to delete this article.']);
        }
    }
}
