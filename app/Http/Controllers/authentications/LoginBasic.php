<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
    public function index()
    {
        return view('content.authentications.auth-login-basic');
    }

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Retrieve input
        $input = $request->only('email', 'password');

        // Determine if input is an email or username
        $field = filter_var($input['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Add the field to the input array
        $credentials = [$field => $input['email'], 'password' => $input['password']];

        // Attempt authentication
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.analytics');
        }

        // Redirect back with error message
        return redirect()->back()->with('error', 'Invalid credentials!')->withInput();
    }

}
