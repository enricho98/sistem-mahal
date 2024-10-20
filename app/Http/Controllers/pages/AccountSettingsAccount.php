<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\User;

class AccountSettingsAccount extends Controller
{
    public function index()
    {
        return view('content.pages.pages-user-settings');
    }

    public function ajaxGetUser()
    {
        $users = User::all();
        return $users;
    }

}
