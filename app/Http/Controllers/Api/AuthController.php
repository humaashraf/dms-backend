<?php
// app/Http/Controllers/API/AuthController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email'    => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     if (!Auth::attempt($request->only('email', 'password'))) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'Invalid email or password',
    //         ], 401);
    //     }

    //     $user = Auth::user();

    //     return response()->json([
    //         'status'  => true,
    //         'message' => 'Login successful',
    //         'user'    => $user,
    //         // 'token'   => $user->createToken('API Token')->plainTextToken
    //     ]);
    // }


    public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'status'  => false,
            'message' => 'Invalid email or password',
        ], 401);
    }

    $user = Auth::user();

    // Generate Sanctum token
    $token = $user->createToken('API Token')->plainTextToken;

    return response()->json([
        'status'  => true,
        'message' => 'Login successful',
        'user'    => $user,
        'token'   => $token // Send token to React
    ]);
}


public function logout(Request $request)
{
    $request->user()->tokens()->delete(); // Delete all user tokens
    return response()->json([
        'status' => true,
        'message' => 'Logged out successfully'
    ]);
}

    // public function logout(Request $request)
    // {
    //     $request->user()->currentAccessToken()->delete();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Logged out successfully'
    //     ]);
    // }

}
