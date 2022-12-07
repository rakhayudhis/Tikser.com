<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'no_hp' => 'required|string|max:255',
            'role_as' => 'required|string|max:255',
            'password' => 'required|string|min:8'
        ]);


        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'no_hp' => $fields['no_hp'],
            'role_as' => $fields['role_as'],
            'password' => Hash::make($fields['password'])
         ]);

        $token = $user->createToken('tokenku')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'unauthorized'
            ], 401);
        }

        $token = $user->createToken('tokenku')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    // method for user logout and delete token
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'Logged Out'
        ];
    }
    
    public function alluser()
    {
        $user = User::all();
        if($user) {
            return response()->json([
                'status' => 200,
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'status' =>404,
                'message' => 'Belum terdapat user'
            ], 404);
        }
    }

    public function showuser ($id){
        $user = User::find($id);
        if($user) {
            return response()->json([
                'status' => 200,
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'status' =>404,
                'message' => 'id atas ' . $id .'tidak ditemukan'
            ], 404);
        }
    }
}
