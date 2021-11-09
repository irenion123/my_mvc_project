@extends('main')

@section('main')
<div class="container">
    <h1 class="mt-4 mb-1"><span class="letter">М</span>ои данные.</h1>
    <div class="indent card pt-3" style="font-size:20px;">
        <p>Имя: {{ Auth::user()['username'] }}</p>
        <p>Дата рождения: {{ (new DateTime(Auth::user()['birthday']))->format('d.m.Y') }}</p>
        <p>Почта: {{ Auth::user()['email'] }}</p>
    </div>
    <div class="mt-4 text-center">
        <a class="btn btn-light" href='{{ route("logout") }}' style="font-size: 20px">Выйти</a>
    </div>

    <div class="container mb-4 mt-4">
        <h1><span class="letter">К</span>ниги на полке.</h1></br>
        <div id="book_shelf" class="row" style="text-align: left;">
        @foreach( $reservedBooks as $book )
            @include('components.book', [ 'book' => $book, 'removable' => true ])
        @endforeach
        </div>
        <div id="empty_indicator" @class([
                'text-center',
                'd-none' => (count($reservedBooks) > 0)
            ])>
            <h5>
                На вашей полке пока пусто, отложите <a href="{{ route('books') }}">книги</a> и они появятся тут
            </h5>
        </div>
    </div>
</div>
<script>
$('#book_shelf').bind('DOMSubtreeModified', function(e) {
    if ($('#book_shelf').children().length < 1) {
        $('#empty_indicator').removeClass('d-none');
    }
});
</script>
@endsection

