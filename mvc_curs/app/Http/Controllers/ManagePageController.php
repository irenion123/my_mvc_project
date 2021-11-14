<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request as Request;
use App\Models\Book;

class ManagePageController extends Controller
{

    public function manageBooks(Book $book)
    {
        return view('manage_pages.books');
    }

}

