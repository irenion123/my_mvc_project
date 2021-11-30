<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function deleteBook(Book $book)
    {
        $result = $book->delete();
        return json_encode(['result' => $result]);
    }

    public function addBook(Request $request)
    {
        $validated = $request->validate([
            'title'           => 'required',
            'authors_id.0'    => 'required',
            'translators_id'  => '',
            'category_id'     => 'required',
            'cover_image'     => 'required',
            'seria_id'        => '',
            'cycle_id'        => '',
            'number_in_cycle' => '',
            'cover_type'      => '',
            'isbn'            => '',
            'ydk'             => '',
            'bbk'             => '',
            'age_restriction' => '',
            'tiraj'           => '',
            'status'          => '',
            'format_id'       => '',
            'publish_date'    => '',
            'page_count'      => '',
            'description'     => '',
        ]);
        $book = new Book;

        $image = $request->file('cover_image');
        $path = $image->storeAs('imgs/covers', $image->getClientOriginalName(), 'public');

        $book->title           = $validated['title'];
        $book->category_id     = $validated['category_id'];
        $book->cover_image     = 'imgs/covers/' . $image->getClientOriginalName();
        $book->seria_id        = ($request->input('seria_id') == -1) ? null : $request->input('seria_id');
        $book->cycle_id        = ($request->input('cycle_id') == -1) ? null : $request->input('cycle_id');
        $book->number_in_cycle = $validated['number_in_cycle'];
        $book->cover_type      = $validated['cover_type'];
        $book->isbn            = $validated['isbn'];
        $book->ydk             = $validated['ydk'];
        $book->bbk             = $validated['bbk'];
        $book->age_restriction = $validated['age_restriction'];
        $book->tiraj           = $validated['tiraj'];
        $book->status          = $validated['status'];
        $book->format_id       = $validated['format_id'];
        $book->publish_date    = $validated['publish_date'];
        $book->page_count      = $validated['page_count'];
        $book->description     = $validated['description'];
        $book->is_bestseller   = empty($request->input('is_bestseller', null)) ? false : true;
        $book->is_shown        = empty($request->input('is_shown', null)) ? false : true;

        $book->save();

        $authors = array_unique($request->input('authors_id'));
        $translators = array_unique(array_filter(
            $request->input('translators_id'),
            function($item)
            {
                return $item != -1;
            }
        ));

        $book->addAuthors($authors);
        $book->addTranslators($translators);

        return redirect()->route('manage_books', '#');
    }

}
