<?php

namespace App\Http\Controllers;

use App\Enums\GenreBook;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller{

    public function index(Request $request){
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $books = Book::where('genre', 'like', '%'.$filter.'%')->paginate(5);
        } else {
            $books = Book::paginate(5);
        }
        return view('books',['books'=>$books])->with('filter', $filter);
    }

    public function create(){
        return view('booksCreate');
    }

    public function addbook(Request $request){
        $data = $request->validate([
            'title' => 'required|max:255',
            'author_name' => 'required|string',
            'published_year' => 'required|integer',
            'genre' => 'in:science,history,adventure,economy',
        ]);
        $newBook = Book::create($data);
        // $book = new Book(

        // );
        // $book->save();

        // $newBook = Book::create([
        //     'title'=>$request->input('title'),
        //     'author_name'=>$request->input('author'),
        //     'genre'=>$request->input('genre'),
        //     'published_year'=>$request->input('year'),
        // ]);
        return redirect(route('books-index'));
    }

    public function editbook(Book $book){
        return view('bookEdit',['book' => $book]);
    }

    public function updatebook(Book $book, Request $request){
        $data = $request->validate([
            'title' => 'required|max:255',
            'author_name' => 'required|string',
            'published_year' => 'required|integer',
            'genre' => 'in:science,history,adventure,economy',
        ]);
        $book->update($data);
        return redirect(route('books-index'))->with('success', 'updated successfully');
    }

    public function deletebook(Book $book){
        $book->delete();
        return redirect(route('books-index'))->with('success', 'deleted successfully');
    }

}
