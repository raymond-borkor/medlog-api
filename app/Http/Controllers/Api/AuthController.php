<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'password' => 'required|min:6|string|',
            'email' => 'required|unique:users|string|email|max:255'
        ]);
        if($validator->fails())
        {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $user = new User();
        $user->name = $request['name'];
        $user->password = Hash::make($request['password']);
        $user->email = $request['email'];
        $user->save();
        $token = $user->createToken('User access token')->accessToken;
        $response = ['token' => $token,
            'message' => "User saved Successfully",
            'user' => $user
            ];
        return response($response, 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:6|string|'
        ]);
        if ($validator->fails())
        {
            return response(["errors" => $validator->errors()->all()], 422);
        }
        $user = User::all()->where('email', $request->email)->first();
        if($user)
        {
            if(Hash::check($request->password, $user->password))
            {
                $token = $user->createToken('User access token')->accessToken;
                $response = ['token' => $token, 'message' => 'Login Successful'];
                return response($response, 200);
            }else{
                return response(['message' => 'Password Mismatch'], 422);
            }
        }else{
            return response(['message' => 'User does not exist'], 422);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        if($token->revoke())
        {
            return response(['message' => 'Log out Initiated', 'response' => $token], 200);
        }else{
            return response(['message' => 'Logout failed', 'response' => $token], 422);
        }
    }


    public function test(Request $request)
    {
        $user = User::all()->where('email', $request->email)->first();
        if(Hash::check($request->password, $user->password))
        {
            return response(['password' => $user->password]);
        }
        return response(['user' => $user]);
    }

}
