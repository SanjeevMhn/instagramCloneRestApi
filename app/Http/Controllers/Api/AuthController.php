<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request){

        $validate = Validator::make($request->all(),[
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'dob' => 'required|date'
        ]);

        if($validate->fails()){
            return response()->json([
                'errors' => $validate->errors(),
            ],400);
        }

        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => bcrypt($validate['password']),
            'dob' => $validate['dob'],
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' =>  'Bearer'
        ]);

    }

    public function login(Request $request){

        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'message' => 'Invalid login details',
            ],401);
        }

        $user = User::where('email',$request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);

    }

    public function me(Request $request){

        $userId = auth('sanctum')->user()->id;
        $posts = Posts::where('user_id',$userId)->orderBy('posts.updated_at','desc')->get();

        return response()->json([
            'user' => $request->user(),
            'uploads' => $posts
        ]);

    }


}
