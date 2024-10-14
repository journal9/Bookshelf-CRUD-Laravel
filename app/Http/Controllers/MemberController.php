<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
class MemberController extends Controller
    {
        public function index(Request $request){
            $email=$request->input('email');
            //error
            $email = 'amara@yahoo.com';
            $user = Member::where('email',$email)->first();
            $all_books = Book::paginate(10);

            return view('members',['all_books'=>$all_books, 'user'=>$user]);
        }
    }
    

