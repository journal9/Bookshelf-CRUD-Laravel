<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book_User;
use App\Models\User;
use App\Models\Book;

class BooksUsersController extends Controller
{
    public function all_user_books(){
        $user_id =  auth()->id();
        $user = User::find($user_id);
        $all_published = $user::with('books')->get();
        return Response([
            'success'=>'true',
            'published'=>$all_published,
        ]);
    }

    public function add_user_book(int $book_id){
        $user_id =  auth()->id();
        $user = User::find($user_id);
        $user->books()->attach($book_id);
        return Response([
            'success'=>'true',
            'book'=>'success',
        ]);
    }

    public function remove_user_book(int $book_id){
        $user_id =  auth()->id();
        $user = User::find($user_id);    
        $user->books()->detach($book_id);
        return Response([
            'success'=>'true',
            'message'=>'book removed from published books'
        ]);
    }
}
