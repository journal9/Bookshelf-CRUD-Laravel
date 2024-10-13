<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class UserController extends Controller
{
    public function index(Request $request){
        $email = $request->query('filter');
        if (!empty($email)) {
            $users = Member::where('email', 'like', '%'.$email.'%')->where('role', '=', 2 )->paginate(5);
        } else {
            $users = Member::where('role', '=', 2 )->paginate(5);
        }
        return view('users',['users'=>$users])->with('filter', $email);
    }

    public function edituser(Member $user){
        return view('userEdit',['user' => $user]);
    }

    public function updateuser(member $user, Request $request){
        $data = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email:rfc,dns',
            'age' => 'required|integer',
            'phone_number' => 'required|string',
        ]);
        $user->update($data);
        return redirect(route('users-index'))->with('success', 'user updated successfully');
    }

    public function deleteuser(Member $user){
        $user->delete();
        return redirect(route('users-index'))->with('success', 'deleted successfully');
    }

    public function create(){
        return view('usersCreate');
    }

    public function adduser(Request $request){
        $newBook = Member::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'age'=>$request->input('age'),
            'role'=>$request->input('role'),
            'password'=>$request->input('password'),
            'phone_number'=>$request->input('phone_number'),
            'subscription_over'=>date('Y-m-d', strtotime('+1 years')),
        ]);
        return redirect(route('users-index'));
    }
}
