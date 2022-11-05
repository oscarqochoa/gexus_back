<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function login(Request $request)
    {

        $auth = Auth::attempt($request->only('email', 'password'));

        if (!$auth) {
            return response()->json(
                [
                    "message" => "Invalid credentials"
                ],
                401
            );
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]
        );
    }
}
