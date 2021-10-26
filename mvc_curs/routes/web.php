<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home_page');
});

Route::get('/books', function () {
    return view('books_page');
});

Route::get('/authors', function () {
    return view('authors_page');
});

Route::get('/contacts', function () {
    return view('contacts_page');
});

Route::get('/auth', function () {
    return view('auth_page');
});

