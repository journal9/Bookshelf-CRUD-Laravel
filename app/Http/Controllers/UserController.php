<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Psr7\Response;

class UserController extends Controller
{
    public function list_users(){
        // $email = $request->query('filter');
        // if (!empty($email)) {
        //     $users = User::where('email', 'like', '%'.$email.'%')->where('role_id', '=', 2 )->paginate(5);
        // } else {
        //     $users = User::where('role_id', '=', 2 )->paginate(5);
        // }
        // return view('admin.users',['users'=>$users])->with('filter', $email);
        $users = User::where('role_id', '=', 2 )->paginate(5);
        return Response([
            'success'=>true,
            'users'=>$users
        ]);
    }

    public function update_user(int $user_id, Request $request){
        $user = User::whereId($user_id)->first();
        $user->update($request->all());
        return Response([
            'success'=>true,
            $user
        ],200);
    }

    public function delete_user(int $user_id){
        $user = User::whereId($user_id);
        $user->delete();
        return Response([
            'success'=>true,
            'message'=>"User deleted successfully"
        ],200);
    }

    public function add_user(Request $request){
        $newUser = User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'age'=>$request->input('age'),
            'role_id'=>$request->input('role_id'),
            'password'=>$request->input('password'),
            'phone_number'=>$request->input('phone_number'),
            'subscription_over'=>date('Y-m-d', strtotime('+1 years')),
        ]);
        return Response([
            'success'=>true,
            'users'=>$newUser
        ],200);
    }
}
