<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Validation;
class TemplateEmailValidationController extends Controller
{
    //
    public function __construct() {
        $this->middleware("permission:tempalte email index")->only(['index']);
        $this->middleware("permission:tempalte email update")->only(['update']);
    }
    public function index()
    {
        // Logic to display the template email validation page
        $template= Validation::first();
        return view('backend.template_email_validation.index',compact('template'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update the template email validation
        // Validate the request data
        $request->validate([
            'paragraph' => 'required',
            'codecolor' => 'required',
            'object'=>'required'
        ]);

        // Find the validation by ID and update it
        $validation = \App\Models\Validation::findOrFail($id);
        $validation->update($request->all());

        // Redirect back with a success message
        $alert = [
            'type' => 'info',
            'message' => 'Template email validation updated successfully.',
        ];
        return redirect()->route('template_email_validation.index')->with($alert);
    }
}
