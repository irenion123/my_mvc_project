<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'book_id';

    public static function getBestSellers($count = 4)
    {
        return self::query()
            ->where('is_bestseller', 1)
            ->join('books_has_authors', 'books.book_id', 'books_has_authors.book_id')
            ->join('authors', 'authors.author_id', 'books_has_authors.author_id')
            ->take($count)
            ->get([ '*', 'authors.fullname as author_fullname' ]);
    }
}

