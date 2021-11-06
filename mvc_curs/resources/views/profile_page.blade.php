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
        <div class="row" style="text-align: left;">
        @each('components.book', $reservedBooks, 'book')
        </div>
    </div>
</div>
@endsection

