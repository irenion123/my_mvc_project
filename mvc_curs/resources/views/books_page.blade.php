@extends('main')

@section('main')

@foreach($categories as $category)
<div class="container mt-4">
    <h1 class="accent-header"> {{ $category->title }} </h1>
    <div class="row" style="text-align: left;">
        @each('components.book', $category->books, 'book')
    </div>
</div>
@endforeach

@endsection
