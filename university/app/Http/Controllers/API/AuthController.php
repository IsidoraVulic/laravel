<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'required|string|min:8|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' =>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response() -> json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Hi ' .$user->name. ', welcome home', 'access_token'=>$token, 'token_type'=>'Bearer',]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return[
            'message' => 'You have successfully logged out.'
        ];
    }

}
