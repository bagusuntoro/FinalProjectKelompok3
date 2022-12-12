<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /*
    * Method untuk daftar
    */
    public function signup(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required'
        ]);
    
        if ($validator->fails())
        {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $request['password'] = bcrypt($request['password']);
    
        User::create($request->toArray());
    
        return response()->json(['message' => 'Successfully signed up. Next step is log in'], 200);        
    }

    /*
    * Method untuk login
    */
    public function login()
    {
        $credentials = request(['email', 'password']);
        $token = auth()->attempt($credentials);
        if(!$token)
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    /*
    * Method untuk logout
    */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    /*
    * Method untuk refresh token
    */
    public function refresh()
    {
        return response()->json([
            'access_token' => auth()->refresh(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    /*
    * Method untuk melihat data user yang sedang login
    */
    public function data()
    {
        return response()->json(auth()->user());
    }
}
