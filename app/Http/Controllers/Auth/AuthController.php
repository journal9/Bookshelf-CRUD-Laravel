<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendWelcomeMail;

class AuthController extends Controller
{
    // public function register_view()
    // {
    //     return view('auth.register_admin');
    // }

    public function register(UserRequest $request)
    {
        $newUser = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'age' => $request->input('age'),
            'role_id' => $request->input('role_id'),
            'password' => $request->input('password'),
            'phone_number' => $request->input('phone_number'),
            'subscription_over' => date('Y-m-d', strtotime('+1 years')),
        ]);

        dispatch(new SendWelcomeMail($newUser));
        
        return response()->json([
            'status' => 'success',
            'message' => 'User created',
            'name' => $newUser->name,
            'email' => $newUser->email,
        ], 201);
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => ['Username or password incorrect'],
            ], 400);
        } else {
            if (! $user->email_verified_at) {
                $user->markEmailAsVerified();
                dispatch(new SendWelcomeMail($user));
            }
            $user->tokens()->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'User logged in successfully',
                'name' => $user->name,
                'token' => $user->createToken('auth_token')->plainTextToken,
            ]);
        }
    }

    public function logout(Request $request)
    {
        if (!$request->user()) {
            return Response([
                'status' => 'failed',
                'message' => 'User token missing'
            ]);
        }
        $request->user()->currentAccessToken()->delete();
        return response()->json(
            [
                'status' => 'success',
                'message' => trans('lang.User_logged_out_successfully')
            ]
        );
    }
}
