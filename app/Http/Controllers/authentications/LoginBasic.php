<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class LoginBasic extends Controller
{
    public function index()
    {
        return view('content.authentications.auth-login-basic');
    }

    // public function login(Request $request)
    // {
    //     // Validate input
    //     $request->validate([
    //         'email' => 'required|string',
    //         'password' => 'required|string',
    //     ]);

    //     // Retrieve input
    //     $input = $request->only('email', 'password');

    //     // Determine if input is an email or username
    //     $field = filter_var($input['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

    //     // Add the field to the input array
    //     $credentials = [$field => $input['email'], 'password' => $input['password']];

    //     $user = auth()->user();

    //     if ($user) {
    //         // Ambil role
    //         $roles = $user->getRoleNames(); // Mengambil semua role
    //         \Log::info('User roles:', ['roles' => $roles]);

    //         // Ambil permissions
    //         $permissions = $user->getAllPermissions(); // Mengambil semua permissions
    //         \Log::info('User permissions:', ['permissions' => $permissions]);
    //     }
    //     // Attempt authentication
    //     if (Auth::attempt($credentials)) {
    //         \Log::info('User logged in:', ['user' => Auth::user()]);
    //         return redirect()->route('dashboard.analytics');
    //     }

    //     // Redirect back with error message
    //     return redirect()->back()->with('error', 'Invalid credentials!')->withInput();
    // }

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Retrieve input
        $input = $request->only('email', 'password');

        // Attempt authentication
        if (Auth::attempt($input)) {
            $user = Auth::user();

            // Cek dan assign role admin
            $role = Role::where('name', 'admin')->first();
            if ($role) {
                $user->assignRole($role);
            }

            return redirect()->route('dashboard.analytics');
        }

        // Redirect back with error message
        return redirect()->back()->with('error', 'Invalid credentials!')->withInput();
    }

}
