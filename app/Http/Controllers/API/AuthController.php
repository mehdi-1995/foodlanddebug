<?php

// app/Http/Controllers/Api/AuthController.php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $tokenResult = $user->createToken('auth_token');
            if ($tokenResult) {
                $token = $tokenResult->plainTextToken;
                return response()->json([
                    'user' => $user,
                    'token' => $token,
                ]);
            } else {
                return response()->json(['message' => 'Failed to create token'], 500);
            }
        }

        return response()->json(['message' => 'شماره موبایل یا رمز عبور اشتباه است'], 401);
    }
}
