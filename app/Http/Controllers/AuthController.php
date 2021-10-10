<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($token = auth('api')->attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json([
                'token' => $token,
                'user' => auth('api')->user()
            ]);
        }else{
            return response()->json([
                'message' => 'Invalid Credential'
            ], 403);
        }
    }

    public function logout(Request $request)
    {
        try {
            auth('api')->logout();

            return response()->json([
                'message' => 'Success Logout'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }
}
