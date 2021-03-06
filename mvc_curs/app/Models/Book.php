<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Models\Category;
use App\Models\Cycle;
use App\Models\Seria;
use App\Models\Format;

class Book extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'book_id';
    public $timestamps = false;

    public static function getBestSellers($count = 4, bool $showHidden = false)
    {
        $query = self::query()
            ->where('is_bestseller', 1)
            ->join('books_has_authors', 'books.book_id', 'books_has_authors.book_id')
            ->join('authors', 'authors.author_id', 'books_has_authors.author_id');
        if (!$showHidden)
            $query = $query->where('is_shown', true);
        return $query->take($count)->get();
    }

    public static function getBooksById(array $ids)
    {
        return self::query()
            ->whereIn('books.book_id', $ids)
            ->get();
    }

    public static function getBookByCategoryId(int $categoryId, bool $showHidden = false)
    {
        $query = self::query()->where('category_id', $categoryId);
        if (!$showHidden)
            $query = $query->where('is_shown', true);
        return $query->get();
    }

    public function getAuthorNameAttribute() {
        $array = DB::select(
            '
                select group_concat(a.fullname separator \', \') as fullname
                from books_has_authors as bhs
                left join authors as a on bhs.author_id = a.author_id
                where bhs.book_id = :id
                group by bhs.book_id
            ',
            [':id' => $this->book_id]
        );

        if (empty($array)) return null;

        return array_column($array, 'fullname')[0];
    }

    public function getTranslatorNameAttribute() {
        $array = DB::select(
            '
                select group_concat(t.fullname separator \', \') as fullname
                from books_has_translators as bht
                left join translators as t on bht.translator_id = t.translator_id
                where bht.book_id = :id
                group by bht.book_id
            ',
            [':id' => $this->book_id]
        );

        if (empty($array)) return null;

        return array_column($array, 'fullname')[0];
    }

    public function getSeriaNameAttribute()
    {
        $seria = Seria::find($this->seria_id);
        if (empty($seria)) return null;
        return $seria->title;
    }

    public function getCycleNameAttribute()
    {
        $cycle = Cycle::find($this->cycle_id);
        if (empty($cycle)) return null;
        return $cycle->title;
    }

    public function getCategoryNameAttribute()
    {
        $category = Category::find($this->category_id);
        if (empty($category)) return null;
        return $category->title;
    }

    public function getFormatNameAttribute()
    {
        $format = Format::find($this->format_id);
        if (empty($format)) return null;
        return $format->name;
    }

    public static function reserveBook($bookId, $userId)
    {
        DB::insert(
            'insert into users_have_books values (:user_id, :book_id)',
            [ ':user_id' => $userId, ':book_id' => $bookId ]
        );
    }

    public static function removeReservation($bookId, $userId)
    {
        DB::delete(
            'delete from users_have_books where user_id = :user_id and book_id = :book_id',
            [ ':user_id' => $userId, ':book_id' => $bookId ]
        );
    }

    public function addAuthors(array $authors)
    {
        $values = [];
        foreach ($authors as $_ => $authorId) {
            $values[] = [
                'book_id' => $this->book_id,
                'author_id' => $authorId,
            ];
        }
        DB::table('books_has_authors')->insert($values);
    }

    public function addTranslators(array $translators)
    {
        $values = [];
        foreach ($translators as $_ => $translatorId) {
            $values[] = [
                'book_id' => $this->book_id,
                'translator_id' => $translatorId,
            ];
        }
        DB::table('books_has_translators')->insert($values);
    }
}

