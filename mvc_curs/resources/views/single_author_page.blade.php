@extends('main')

@section('main')
<div class="mt-5 container">
    <div class="row">
        <!-- Картинка -->
        <div class="col-lg-6 col-12">
            <div class="book-image" style="background: url('{{ asset($author->photo) }}'); background-size: contain; background-position: center;"></div>
        </div>  
        <!-- Описание книги -->
        <div class="col-lg-6 col-12 name-prepod mt-3 mb-3">
            @isset($author->fullname)
            <p style="font-size: 30px;">{{ $author->fullname }}</p>
            @endisset

            @isset($author->birthday)
            <p>Дата рождения: {{ $author->birthday }}</p>
            @endisset
            
            @isset($author->description)
            <p>Биография:</p>
            <p style="font-size:16px;">{{ $author->description }}</p>
            @endisset
            
        </div>
    </div>
</div>
</div>
@endsection


