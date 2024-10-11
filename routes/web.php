<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/books',[BookController::class,'index'])->name('books-index');

Route::get('/books/create',[BookController::class,'create'])->name('books-create');

Route::post('/books/add',[BookController::class,'addbook'])->name('books-add');

Route::get('/books/{book}/edit',[BookController::class,'editbook'])->name('books-edit');

Route::put('/books/{book}/update',[BookController::class,'updatebook'])->name('books-update');

Route::delete('/books/{book}/delete',[BookController::class,'deletebook'])->name('books-del');