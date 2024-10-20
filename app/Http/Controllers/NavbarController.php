<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NavbarController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Get the currently authenticated user
        dd($user);
        return view('layouts.sections.navbar.navbar', compact('user')); // Pass the user to the view
    }
}
// layouts/sections/navbar/navbar
