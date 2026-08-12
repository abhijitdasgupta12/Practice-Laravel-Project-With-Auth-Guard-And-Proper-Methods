<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class WebController extends Controller
{
    public function login()
    {
        if(auth()->guard('web')->check())
        {
            return redirect()->route('user.dashboard');
        }
        return view('userlogin');
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember') ? true : false;

        if(auth()->guard('web')->attempt($credentials, $remember)){
            $request->session()->regenerate();
            // return response()->json(auth()->guard('web')->user()->email);
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([ 'email' => 'The provided credentials are incorrect.', ])->onlyInput('email'); 
    }

    public function signup()
    {
        if(auth()->guard('web')->check())
        {
            return redirect()->route('user.dashboard');
        }
        return view('usersignup');
    }

    public function postsignup(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        try{
            $users = User::create($validated);

            Auth::login($users);

            $request->session()->regenerate();

            return response()->json([
                'data' => auth()->guard('web')->user()
            ]);
        }
        catch(err){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function sendforgotemail()
    {
        return view('forgotpasswordsendemailforuser');
    }

    public function changepasswordpage(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');

        return view('userforgotpassword')->with(['token' => $token, 'email' => $email]);
    }

    // SENDS EMAIL FOR PASSWORD RESET
    public function forgotpassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'string']
        ]);

        $email = $request->only('email');
        
        $status = Password::broker('users')->sendResetLink(['email'=>$email]);

        return redirect()->route('user.login')->with(['message' => $status === Password::RESET_LINK_SENT ? "Email reset link has been sent to your inbox" : "An error occurred"]);
    }

    // RESETS PASSWORD
    public function resetuserpassword(Request $request)
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

        $status = Password::broker('users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) //$user = User record matching the email & $password = request's "password" field
            {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET ? redirect()->route('user.login')->with(['email' => 'Password has been reset']) : ok("ERROR: FAILED");
    }

    public function dashboard()
    {
        return view('userdashboard');
    }

    public function logout(Request $request)
    {
        auth()->guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['success' => true]);
    }
}
