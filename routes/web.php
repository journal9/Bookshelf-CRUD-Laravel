<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RouteController;

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

Route::controller(BookController::class)->prefix('books')->group(function(){

    Route::get('/','index')->name('books-index');  
    Route::get('/create','create')->name('books-create');
    Route::post('/add','addbook')->name('books-add');
    Route::get('/{book}/edit','editbook')->name('books-edit');
    Route::put('/{book}/update','updatebook')->name('books-update');
    Route::delete('/{book}/delete','deletebook')->name('books-del');
});

Route::post('/route',[RouteController::class,'route'])->name('login-route');

Route::get('/users',[UserController::class,'index'])->name('users-index');

Route::get('/users/{user}/edit',[UserController::class,'edituser'])->name('users-edit');

Route::delete('/users/{user}/delete',[UserController::class,'deleteuser'])->name('users-del');

Route::put('/users/{user}/update',[UserController::class,'updateuser'])->name('users-update');

Route::get('/users/create',[UserController::class,'create'])->name('users-create');

Route::post('/users/add',[UserController::class,'adduser'])->name('users-add');

Route::get('/member',[MemberController::class,'index'])->name('member-page');