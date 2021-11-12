@extends('main')

@section('main')

<div class="container mt-4">
    <h1>
        <span class="letter">А</span>вторы
    </h1>
    <div class="row" style="text-align: left;">
        @each('components.author', $authors, 'author')
    </div>
</div>

@endsection
