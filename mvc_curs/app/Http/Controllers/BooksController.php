<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Book;

class BooksController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    public function show(Book $book)
    {
        return $book;
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title'           => 'required',
            'authors_id.*'    => 'required|distinct',
            'translators_id.*'=> 'distinct',
            'category_id'     => 'required|exists:App\Models\Category',
            'cover_image'     => 'required|file|image',
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
        
        if ($validation->fails()) {
            return $this->jsonError($validation->errors());
        }
        $validated = $validation->validated();

        // Заполняем стандартные значения
        $validated['translators_id'] = $validated['authors_id'] ?? [];

        $book = new Book;

        $image = $request->file('cover_image');
        $path = $image->storeAs('imgs/covers', $image->getClientOriginalName(), 'public');

        $book->title           = $validated['title'];
        $book->category_id     = $validated['category_id'];
        $book->cover_image     = 'imgs/covers/' . $image->getClientOriginalName();
        $book->seria_id        = ($request->input('seria_id') == -1) ? null : $request->input('seria_id');
        $book->cycle_id        = ($request->input('cycle_id') == -1) ? null : $request->input('cycle_id');
        $book->number_in_cycle = $validated['number_in_cycle'] ?? null;
        $book->cover_type      = $validated['cover_type'] ?? null;
        $book->isbn            = $validated['isbn'] ?? null;
        $book->ydk             = $validated['ydk'] ?? null;
        $book->bbk             = $validated['bbk'] ?? null;
        $book->age_restriction = $validated['age_restriction'] ?? null;
        $book->tiraj           = $validated['tiraj'] ?? null;
        $book->status          = $validated['status'] ?? null;
        $book->format_id       = $validated['format_id'] ?? null;
        $book->publish_date    = $validated['publish_date'] ?? null;
        $book->page_count      = $validated['page_count'] ?? null;
        $book->description     = $validated['description'] ?? null;
        $book->is_bestseller   = empty($request->input('is_bestseller', null)) ? false : true;
        $book->is_shown        = empty($request->input('is_shown', null)) ? false : true;

        $book->save();

        $authors = array_unique($request->input('authors_id'));
        $translators = array_unique(array_filter(
            $validated['translators_id'],
            function($item)
            {
                return $item != -1;
            }
        ));

        $book->addAuthors($authors);
        $book->addTranslators($translators);

        return $this->jsonSuccess([ 'id' => $book->book_id ]);
    }
}
