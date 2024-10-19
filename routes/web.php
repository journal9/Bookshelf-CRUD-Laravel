<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

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

Route::post('/route',[AdminController::class,'routeByRole'])->name('login-route');
Route::get('/member',[MemberController::class,'index'])->name('member-page');


Route::controller(BookController::class)->prefix('books')->group(function(){

    Route::get('/','index')->name('books-admin-index');  
    Route::get('/create','create')->name('books-create');
    Route::post('/add','addbook')->name('books-add');
    Route::get('/{book}/edit','editbook')->name('books-edit');
    Route::put('/{book}/update','updatebook')->name('books-update');
    Route::delete('/{book}/delete','deletebook')->name('books-del');
});


Route::controller(UserController::class)->prefix('users')->group( function(){
    Route::get('/','index')->name('users-index');
    Route::get('/{user}/edit','edituser')->name('users-edit');
    Route::delete('/{user}/delete','deleteuser')->name('users-del');
    Route::put('/{user}/update','updateuser')->name('users-update');
    Route::get('/create','create')->name('users-create');
    Route::post('/add','adduser')->name('users-add');
});

Route::controller(MemberController::class)->prefix('member')->group( function(){
    Route::get('/','index')->name('members-index');
    Route::get('/{book}/{user}/add','addBookToUser')->name('members-add');
    Route::delete('/{book}/{user}/delete','removeBookFromUser')->name('members-del');
    // Route::put('/{book}/update','updateuser')->name('member');
});

