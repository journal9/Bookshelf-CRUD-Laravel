<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class RouteController extends Controller
{
    public function route(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        $user = Member::where('email',$email)->first();
        if(!$user){
            return redirect(route('login-route'));
        }
        if($user and Hash::check($password,$user->password)){
            if($user->role==1){
                return redirect(route('books-index'));
            }
            else{
                return redirect(route('member-page',['user'=>$user]));
            }
        }
        else{
            return redirect(route('login-route'));
        }
    }
}
