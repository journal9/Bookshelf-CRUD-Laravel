<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\Book_Member;

class MemberController extends Controller
    {
        public function index(Member $user){
            $all_books = Book::paginate(10);
            return view('members',['all_books'=>$all_books,'user'=>$user]);
        }

        public function addBookToUser($book,Member $user){
            $user->books()->attach($book);
            return redirect(route('members-index'));
            
        }

        public function removeBookFromUser($book,Member $user){
            $user->books()->detach($book);
            return redirect(route('members-index'));
        }


    }
    

