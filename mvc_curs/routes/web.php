<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\BooksPageController;
use App\Http\Controllers\AuthorsPageController;
use App\Http\Controllers\ContactsPageController;
use App\Http\Controllers\ProfilePageController;
use App\Http\Controllers\AuthPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/', [HomePageController::class, 'index']
)->name('home');

/** Книги */
Route::get(
    '/books', [ BooksPageController::class, 'index' ]
)->name('books');
Route::get(
    '/books/{book}/', [ BooksPageController::class, 'bookPage' ]
)->name('single_book');


Route::get(
    '/authors', [ AuthorsPageController::class, 'index' ]
)->name('authors');
Route::get(
    '/contacts', [ ContactsPageController::class, 'index' ]
)->name('contacts');
Route::get(
    '/profile', [ ProfilePageController::class, 'index' ]
)->name('profile');

/**
 * Auth роуты
 */
Route::get(
    '/auth', [ AuthPageController::class, 'index' ]
)->name('auth');
Route::post(
    '/auth', [AuthPageController::class, 'auth']
)->name('auth_post');
Route::get(
    '/logout', [ AuthPageController::class, 'logout' ]
)->name('logout');

Route::prefix('admin')->group(function() {
    Route::get(
        '/temp',
        [BooksPageController::class, 'index']
    )->middleware('auth');
    Route::get(
        '/test',
        [BooksPageController::class, 'index']
    )->middleware('auth');
});
 
