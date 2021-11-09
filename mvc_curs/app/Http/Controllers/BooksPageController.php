<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class BooksPageController extends Controller
{

    public function index()
    {

        $categoriesModel = Category::all();

        $categories = [];
        foreach ($categoriesModel as $category) {
            $category['books'] = Book::getBookByCategoryId($category->category_id);
            $categories[] = $category;
        }
        //

        // Рендерим
        return view('books_page', [
            'categories' => $categories
        ]);
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
