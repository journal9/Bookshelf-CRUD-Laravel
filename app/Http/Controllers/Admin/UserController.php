<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Exceptions\Handlers\UniqueConstraintViolationExceptionHandler;
use App\Http\Requests\UserRequest;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\UniqueConstraintViolationException;

class UserController extends Controller
{
    public function list_users(Request $request)
    {
        // dd($request->header());
        $users = User::where('role_id', '=', 2)->paginate(5);
        return Response([
            'success' => true,
            'users' => $users
        ],200);
    }

    public function update_user(int $user_id, UserRequest $request)
    {
        $user = User::whereId($user_id)->first();
        if(! $user){
            return Response([
                'success'=>true,
                'message'=>"User does not exist.",
            ],422);
        }
        $user->update($request->all());
        return Response([
            'success' => true,
            'message' =>'User data updated'
        ], 200);
    }

    public function delete_user(int $user_id)
    {
        $user = User::whereId($user_id)->first();
        if(! $user){
            return Response([
                'success'=>true,
                'message'=>"User does not exist.",
            ],422);
        }
        $user->delete();
        return Response([
            'success' => true,
            'message' => "User deleted successfully"
        ], 200);
    }

    public function add_user(UserRequest $request)
    {
        try {
            // dd($request->only(['role_id']));SSS
            $newUser = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'age' => $request->input('age'),
                'role_id' => $request->input('role_id'),
                'password' => $request->input('password'),
                'phone_number' => $request->input('phone_number'),
                'subscription_over' => date('Y-m-d', strtotime('+1 years')),
            ]);
            return Response([
                'success' => true,
                'users' => $newUser
            ], 201);
        } catch (UniqueConstraintViolationException $exception) {
            $handler = app()->make(UniqueConstraintViolationExceptionHandler::class);
            return $handler->handle($exception);
        }
    }
}
