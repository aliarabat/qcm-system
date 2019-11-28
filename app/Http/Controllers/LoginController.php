<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|string|email|min:10',
                'password' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9yZWdpc3RlciIsImlhdCI6MTU3NDY5MzIwNywiZXhwIjoxNTc0Njk2ODA3LCJuYmYiOjE1NzQ2OTMyMDcsImp0aSI6IlFVNG93MzE3Rzl5cmlIMFgiLCJzdWIiOjE4LCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.oV-9qBk7TGbcnHP1RGQYNwrJxdEnNdaSEmnWC3LWyTs";
        $credentials = $request->only('email', 'password');
        try {
            if (!$token == JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid email or pwd'], 401);
            }
        } catch (Throwable $th) {
            return response()->json(['error' => 'Unknown Error'], 401);
        }
        return response()->json(compact('token'));
    }
}
