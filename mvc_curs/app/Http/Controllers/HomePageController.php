<?php

namespace App\Http\Controllers;

class HomePageController extends Controller
{

    public function index()
    {

        // Получаем несколько бестселлеров
        //
        // Получаем картинки для карусели
        //
        // Рендерим
        return view('home_page');
    }

}
