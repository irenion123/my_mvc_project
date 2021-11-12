<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorsPageController extends Controller
{

    public function index()
    {
        // Получаем всех авторов
        $authors = Author::all();
        // Рендерим
        return view('authors_page', [
            'authors' => $authors
        ]);
    }

    public function authorPage(Author $author)
    {
        return view(
            'single_author_page',
            ['author' => $author]
        );
    }

}
