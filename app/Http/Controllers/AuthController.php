<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->check()){
            return redirect()->route('admin.dashboard');
        }
        return view('welcome');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember') ? true : false;

        if(auth()->guard('admin')->attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([ 'email' => 'The provided credentials are incorrect.', ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true
        ]);
    }
}
