<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;

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

    public function addReservation(Book $book)
    {
        if (in_array($book->book_id, Auth::user()->reserved_books)) {
            return json_encode(['result' => true]);
        }
        try {
            Book::reserveBook($book->book_id, Auth::user()->user_id);
            return json_encode(['result' => true]);
        } catch (\Exception $e) {
            return json_encode(['result' => false]);
        }
    }

    public function removeReservation(Book $book)
    {
        if (!in_array($book->book_id, Auth::user()->reserved_books)) {
            return json_encode(['result' => true]);
        }
        try {
            Book::removeReservation($book->book_id, Auth::user()->user_id);
            return json_encode(['result' => true]);
        } catch (\Exception $e) {
            return json_encode(['result' => false]);
        }
    }

}
