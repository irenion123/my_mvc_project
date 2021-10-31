<?php

namespace App\Http\Controllers;

class AuthorsPageController extends Controller
{

    public function index()
    {

        // Получаем несколько бестселлеров
        //
        // Получаем картинки для карусели
        //
        // Рендерим
        //
        return view('authors_page');
    }

}
