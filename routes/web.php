<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

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
    return view('login');
});

Route::get('/books',[BookController::class,'index'])->name('books-index');

Route::get('/books/create',[BookController::class,'create'])->name('books-create');

Route::post('/books/add',[BookController::class,'addbook'])->name('books-add');

Route::get('/books/{book}/edit',[BookController::class,'editbook'])->name('books-edit');

Route::put('/books/{book}/update',[BookController::class,'updatebook'])->name('books-update');

Route::delete('/books/{book}/delete',[BookController::class,'deletebook'])->name('books-del');

Route::get('/users',[UserController::class,'index'])->name('users-index');

Route::get('/user/{user}/edit',[UserController::class,'edituser'])->name('users-edit');

Route::delete('/user/{user}/delete',[UserController::class,'deleteuser'])->name('users-del');

Route::put('/users/{user}/update',[UserController::class,'updateuser'])->name('users-update');

Route::get('/users/create',[UserController::class,'create'])->name('users-create');

Route::post('/users/add',[UserController::class,'adduser'])->name('users-add');