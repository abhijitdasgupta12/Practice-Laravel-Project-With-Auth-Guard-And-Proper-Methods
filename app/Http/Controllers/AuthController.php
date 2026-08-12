<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->check()){
            return redirect()->route('admin.dashboard');
        }
        return view('welcome');
    }

    // A DISPLAY PAGE THAT CONTAINS A BUTTON TO SEND PASSWORD RESET EMAIL. THIS IS FOR ADMIN ONLY.
    public function sendforgotemail()
    {
        return view('forgotpasswordsendemail');
    }

    // SENDS EMAIL FOR PASSWORD RESET
    public function forgotpassword(Request $request)
    {
        $email = env('ADMIN_EMAIL');
        
        $status = Password::broker('admins')->sendResetLink(['email'=>$email]);

        return redirect()->route('admin.password.sendemail')->with(['message' => $status === Password::RESET_LINK_SENT ? "Email reset link has been sent to your inbox" : "An error occurred"]);
    }

    // WHEN RECEIVING PASSWORD RESET EMAIL, IT WILL CONTAIN A TOKEN AND EMAIL IN URL AND THEY ARE NEEDED TO BE PASSED TO PASSWORD RESET PAGE
    public function changepasswordpage(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');
        return view('adminforgotpassword')->with(['token' => $token, 'email' => $email]);
    }

    // RESETS PASSWORD
    public function resetadminpassword(Request $request)
    {
        $validation_result = $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        if(!$validation_result)
        {
            return back()->withErrors([ 'email' => 'Passwords should be a match and atleast 8 characters long.', ]);
        }

        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($admin, $password) //$admin = Admin record matching the email & $password = request's "password" field
            {
                $admin->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET ? redirect()->route('admin.login.page')->with(['email' => 'Password has been reset']) : ok("ERROR: FAILED");
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
