<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Exceptions\Handlers\UniqueConstraintViolationExceptionHandler;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\UniqueConstraintViolationException;

class UserController extends Controller
{
    public function list_users()
    {
        $users = User::where('role_id', '=', 2)->paginate(5);
        return Response([
            'success' => true,
            'users' => $users
        ]);
    }

    public function update_user(int $user_id, Request $request)
    {
        $user = User::whereId($user_id)->first();
        $user->update($request->all());
        return Response([
            'success' => true,
            $user
        ], 200);
    }

    public function delete_user(int $user_id)
    {
        $user = User::whereId($user_id);
        $user->delete();
        return Response([
            'success' => true,
            'message' => "User deleted successfully"
        ], 200);
    }

    public function add_user(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email:rfc,dns',
                'age' => 'required|integer',
                'role_id' => 'required|integer',
                'password' => 'required|string|max:50',
                'phone_number' => 'required|string',
            ]);
        } catch (Exception $e) {
            return Response([
                'success' => false,
                'message' => "Invalid argument"
            ], 400);
        }
        try {
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
            ], 200);
        } catch (UniqueConstraintViolationException $exception) {
            $handler = app()->make(UniqueConstraintViolationExceptionHandler::class);
            return $handler->handle($exception);
        }
    }
}
