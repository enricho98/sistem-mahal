<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Analytics extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
        $user = Auth::user(); // Get the currently authenticated user

        return view('content.dashboard.dashboards-analytics', compact('user'));
    }
}
