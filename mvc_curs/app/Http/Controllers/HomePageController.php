<?php

namespace App\Http\Controllers;

use App\Models\Book;

class HomePageController extends Controller
{

    public function index()
    {

        $bestSellers = Book::getBestSellers();
        // Получаем несколько бестселлеров
        //
        // Получаем картинки для карусели
        //
        // Рендерим
        return view('home_page', [
            'bestSellers' => $bestSellers
        ]);
    }

}
