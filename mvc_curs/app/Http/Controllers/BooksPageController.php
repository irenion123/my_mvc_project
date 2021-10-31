<?php

namespace App\Http\Controllers;

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

}
