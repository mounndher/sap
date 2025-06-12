<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index()
    {
        // Logic to retrieve and display settings
        $settings = Setting::first();
        return view('backend.settings.index', compact('settings'));
    }
    public function update(Request $request, $id)
    {
        // Logic to update settings
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'keywords' => 'nullable|string|max:255',
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Handle file uploads for logo and favicon
        // Update or create the settings
        $settings = Setting::find($id);
        $imagePath = handleUpload('logo', $settings);
        $imagePath1 = handleUpload('favicon', $settings);

        $settings->title = $request->title;
        $settings->description = $request->description;
        $settings->keywords = $request->keywords;
        $settings->logo = (!empty($imagePath) ? $imagePath : $settings->logo);               // Keep existing logo if not updated
        $settings->favicon = (!empty($imagePath1) ? $imagePath1: $settings->favicon);         // Keep existing favicon if not updated
        // If the settings do not exist, create a new one
        $settings->save();

        // Save the settings logic here

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
