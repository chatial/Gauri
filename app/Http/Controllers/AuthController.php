<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentianls = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentianls)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        alert()->error('Login Gagal', 'Harap masukan email dan password yang benar.');
        return back()->withInput();
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
