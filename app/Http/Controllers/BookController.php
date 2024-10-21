<?php

namespace App\Http\Controllers;

use App\Enums\GenreBook;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;

class BookController extends Controller{

    public function list_books(Request $request){
        // $user = auth()->user();
        // $u = $request->user();
        // dd($u);
        $filter = $request->query('filter');
        $genre = Genre::where('name',$filter)->first()->id;
        if (!empty($filter)) {
            $books = Genre::find($genre)->books;
        } else {
            $books = Book::paginate(5);
        }
        return response()->json(
            [
                'status' => 'success',
                $books
            ],200);
    }

    public function add_book(Request $request){
        $data = $request->validate([
            'title' => 'required|max:255',
            'author_name' => 'required|string',
            'published_year' => 'required|integer',
            'genre_id' => 'required|integer',
        ]);
        $newBook = Book::create($data);

        return response()->json(
            [
                'status' => 'success',
                'book'=>$newBook
            ],200);
    }

    public function update_book(int $book_id, Request $request){
        $book = Book::whereId($book_id)->first();
        $book->update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'book'=>$book
            ],200);
    }

    public function delete_book(int $book_id){
        $book = Book::whereId($book_id);
        $book->delete();
        return response()->json(
            [
                'status' => 'success',
                'message'=>'successfully deleted'
            ],200);
    }

}
