<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Book;

class ProfilePageController extends Controller
{

    public function index()
    {
        $reservedBooks = Book::getBooksById(
            Auth::user()->reserved_books
        );
        return view(
            'profile_page',
            [ 'reservedBooks' => $reservedBooks ]
        );
    }

}

