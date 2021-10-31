<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\BooksPageController;
use App\Http\Controllers\AuthorsPageController;
use App\Http\Controllers\ContactsPageController;

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

Route::get('/', [HomePageController::class, 'index']);
Route::get('/books', [ BooksPageController::class, 'index' ]);
Route::get('/authors', [ AuthorsPageController::class, 'index' ]);
Route::get('/contacts',  [ ContactsPageController::class, 'index' ]);
Route::get('/auth',  function () {
    return view('auth_page');
});
 
