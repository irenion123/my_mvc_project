@extends('main')

@section('main')

@foreach($categories as $category)
<div class="container mt-4">
    <h1>
        <span class="letter">{!! mb_substr($category->title, 0, 1) !!}</span>{{ mb_substr($category->title, 1) }}
    </h1>
    <div class="row" style="text-align: left;">
        @each('components.book', $category->books, 'book')
    </div>
</div>
@endforeach

@endsection
