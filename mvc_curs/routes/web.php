<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\BooksPageController;
use App\Http\Controllers\AuthorsPageController;
use App\Http\Controllers\ContactsPageController;
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
Route::get(
    '/books', [ BooksPageController::class, 'index' ]
)->name('books');
Route::get(
    '/authors', [ AuthorsPageController::class, 'index' ]
)->name('authors');
Route::get(
    '/contacts', [ ContactsPageController::class, 'index' ]
)->name('contacts');
Route::get('/auth',  function () {
    return view('auth_page');
});
 
