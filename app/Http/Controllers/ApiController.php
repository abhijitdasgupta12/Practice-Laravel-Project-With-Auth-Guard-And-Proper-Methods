<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function userlogin(Request $request)
    {
        $validation = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(!$validation)
        {
            return response()->json(['message' => 'Invalid credentials format'], 401);
        }

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($validation['password'], $user->password))
        {
            return response()->json(['message' => 'Invalid credenntials'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);

    }

    public function getallusers(Request $request)
    {
        return response()->json([
            'message' => "Hello world!"
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
