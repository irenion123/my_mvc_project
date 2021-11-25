<div id="book-view-{{ $book->book_id }}" class="col-sm-6 col-md-4 col-lg-3 col-12 pr d-flex flex-column justify-content-between book-view" style="margin-bottom: 30px;">
    <a class="name-prepod" href="{{ route('single_book', ['book' => $book->book_id]) }}">
    <div class="book-image bg-white" style="background: url('{{ asset($book['cover_image']) }}'); background-size: contain; background-position: center;"></div>
        <hr style="width: 100%; border: none; height: 2px;">
        <span>{{ $book['title'] }}</span></br>
        <span class="author_text text-secondary">{{ $book['author_name'] }}</span>
    </a>
    <div class="mt-3">
        @if (Auth::check())
            @if (in_array($book['book_id'], Auth::user()['reserved_books']))
            <button class="btn btn-light" onclick="removeReservation('{{ $book['book_id'] }}', this @isset($removable) , true @endisset)">Убрать</button>
            @else
            <button class="btn btn-light" onclick="addReservation('{{ $book['book_id'] }}', this)">Отложить</button>
            @endif
        @else
        <a href="{{ route('auth') }}" class="btn btn-light">Отложить</a>
        @endif
    </div>
</div>

