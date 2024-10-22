<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\BooksUsersController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureAdminUser;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/email/verify/{id}/{hash}', [VerificationController::class,'VerifyEmail'])->name('verification.verify');
Route::post('/email/sendVerify', [VerificationController::class,'sendVerificationMail'])->name('verification.resend');

Route::controller(AuthController::class)->prefix('auth')->group(function(){
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::get('/logout','logout')->middleware('auth:sanctum');
});

Route::controller(BookController::class)->prefix('books')->middleware(['auth:sanctum','role.admin'])->group(function(){
    Route::get('/','list_books')->name('books-index');  
    Route::post('/add','add_book')->name('books-add');
    Route::put('/{id}/update','update_book')->name('books-update');
    Route::delete('/{id}/delete','delete_book')->name('books-del');
});


Route::controller(UserController::class)->prefix('users')->middleware(['auth:sanctum','role.admin'])->group( function(){
    Route::get('/all','list_users');
    Route::post('/add','add_user');
    Route::put('/{book_id}/update','update_user');
    Route::delete('/{book_id}/remove','delete_user');
});

Route::controller(BooksUsersController::class)->prefix('published')->middleware('auth:sanctum')->group( function(){
    Route::get('/all','all_user_books')->name('published-index');
    Route::delete('/{user_id}/delete','remove_user_book')->name('book-del');
    Route::post('/{user_id}/add','add_user_book')->name('book-add');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
