<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request as Request;

use App\Models\Book;
use App\Models\Cycle;
use App\Models\Seria;
use App\Models\Author;
use App\Models\Format;
use App\Models\Category;
use App\Models\Translator;

class ManagePageController extends Controller
{

    public function manageBooks(Book $book)
    {
        return view(
            'manage_pages.books',
            [
                'choosen_book'=> count($book->toArray()) > 0 ? $book : null,
                'authors'     => Author::all(),
                'translators' => Translator::all(),
                'categories'  => Category::all(),
                'series'      => Seria::all(),
                'cycles'      => Cycle::all(),
                'formats'     => Format::all(),
                'books'       => Book::all(),
            ]
        );
    }

}

