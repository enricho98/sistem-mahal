<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('destroy');
    }
    protected function getGuard()
    {
        return 'web';
    }
    public function create()
    {
        return view('content.authentications.auth-login-basic');

    }
    public function index()
    {
        \Log::info('User accessing account settings:', ['user' => auth()->user()]);
        return view('content.pages.pages-user-settings');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tentukan field untuk autentikasi
        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $credentials = [$field => $request->email, 'password' => $request->password];

        // Mencoba autentikasi
        if (Auth::attempt($credentials)) {
            // Logika setelah login berhasil
            return redirect()->intended('/dashboard/analytics'); // Atau ke rute lain sesuai keinginan
        }

        // Kembali dengan error jika gagal
        return redirect()->back()->with('error', 'Invalid credentials!')->withInput();
    }

    public function destroy(Request $request)
    {
        // Log the user out
        Auth::guard($this->getGuard())->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the home page
        return redirect('/');
    }
}
