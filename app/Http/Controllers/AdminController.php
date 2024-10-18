<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function routeByRole(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        $user = Member::where('email',$email)->first();
        
        if(!$user){
            return redirect(route('login-route'));
        }
        if($user and Hash::check($password,$user->password)){
            if($user->role==1){
                return redirect(route('books-admin-index'));
            }
            else{
                return redirect(route('books-admin-index'));
                $all_books = Book::paginate(10);
                return view('members',['all_books'=>$all_books,'user'=>$user]);
            }
        }
        else{
            return redirect(route('login-route'));
        }
    }
}
