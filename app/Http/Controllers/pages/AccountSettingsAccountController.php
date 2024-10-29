<?php

namespace App\Http\Controllers\pages;

use App\Enums\PermissionEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AccountSettingsAccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:' . PermissionEnum::UserIndex->value)->only(['index', 'ajaxGetUser']);
    }

    public function index()
    {
        return view('content.pages.pages-user-settings');
    }

    public function ajaxGetUser()
    {
        try {
            $users = User::all()->map(function ($user) {
                $user->created_at_formatted = $user->created_at->format('Y-m-d H:i:s');
                return $user;
            });

            return $users;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function createUser(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8',
        //     'role' => 'required|string|exists:roles,name',
        // ]);
        // dd(234);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role to user
        // $user->assignRole($request->role);

        return response()->json(['message' => 'User created successfully!'], 201);
    }

}
