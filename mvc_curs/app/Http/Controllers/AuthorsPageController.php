<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

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

    public function addAuthor(Request $request)
    {
        $fullname = $request->input('fullname');
        if ($fullname === null) {
            return json_encode( ['result' => false] );
        }

        $author = new Author();
        $author->fullname = $fullname;
        $author->save();

        return json_encode([ 'result' => true, 'id' => $author->author_id ]);
    }

}
