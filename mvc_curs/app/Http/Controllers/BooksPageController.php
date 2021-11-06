<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BooksPageController extends Controller
{

    public function index()
    {

        // Получаем несколько бестселлеров
        //
        // Получаем картинки для карусели
        //

        // Рендерим
        return view('books_page');
    }

    public function bookPage(Book $book)
    {
        return view('single_book_page', ['book' => $book]);
    }

}
