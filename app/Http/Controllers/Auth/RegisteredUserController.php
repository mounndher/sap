<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    $credentials = $request->only('name', 'password');

    if (!Auth::attempt($credentials)) {
        return back()->withErrors([
            'name' => 'Invalid credentials.',
        ]);
    }

    $request->session()->regenerate();

    return redirect()->intended(RouteServiceProvider::HOME);
}

}
