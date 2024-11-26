<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "data" => [
                    "errors" => $validator->invalid()
                ]
            ], 422);
        }

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['Incorrect Username or Password!']
            ]);
        }

        $token = $user->createToken("tokenName")->plainTextToken;

        return response()->json([
            "data" => [
                "token" => $token
            ]
            ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ], 201);

        if (!$user) {
            return response()->json(['message' => 'Error Registering User'], 500);
        }

        return response()->json(['message' => 'User Registered Successfully', 'User' => $user]);
    }

    public function logout(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['error' => 'Please Login First'], 401);
        }

        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout Success'], 200);
    }
}
