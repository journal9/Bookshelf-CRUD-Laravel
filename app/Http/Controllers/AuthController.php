<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Book;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register_view(){
        return view('auth.register_admin');
    }

    public function register(Request $request){
        //   $validatedData = $request->validate([
        //       'name' => 'required|string|max:255',
        //       'email' => 'required|string|email|max:255|unique:users',
        //       'password' => 'required|string|min:8',
        //       'age'=>'integer',
        //       'phone_number'=>'string',
        //       'role_id'=>'required|integer',
        //     ]);
            $newUser = User::create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'age'=>$request->input('age'),
                'role_id'=>$request->input('role_id'),
                'password'=>$request->input('password'),
                'phone_number'=>$request->input('phone_number'),
                'subscription_over'=>date('Y-m-d', strtotime('+1 years')),
            ]);
            // return redirect(route('books-admin-index'));
            //return view('auth.login');
            return response()->json([
                'status' => 'success',
                'message' => 'User created',
                'name' => $newUser->name,
                'email' => $newUser->email,
            ],201);
        }

    public function login(Request $request){
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)){
        return response()->json([
            'message' => ['Username or password incorrect'],
        ],400);
        }

        if($user and Hash::check($request->password,$user->password)){
            $user->tokens()->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'User logged in successfully',
                'name' => $user->name,
                'token' => $user->createToken('auth_token')->plainTextToken,
            ]);
        }
    }

    public function logout(Request $request){
        if (!$request->user()){
            return Response([
                'status'=>'failed',
                'message'=>'User token missing'
            ]);
        }
        $request->user()->currentAccessToken()->delete();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'User logged out successfully'
            ]);
  }
}