@extends('main')

@section('main')
<div class="main px-4 pt-5">
    <div class="container card p-4 mb-3 mt-1">
        <h2 class="text-center"> Книги </h2>
        @foreach ( $books as $book )
            <div id="book-view-{{ $book->book_id }}" class="item d-flex justify-content-between align-items-center mb-1 py-1">
                <div class="cursor-pointer">
                    <span class="h5 item-num cursor-default">{{ $book->book_id }}.</span>
                    <span
                        class="h4 cursor-pointer {{ $book->title ? '' : 'text-secondary' }}"
                        onclick="document.location.assign('{{ route('single_book', ['book' => $book->book_id]) }}')"
                    >
                        {{ $book->title ?? 'Название отсутствует' }}
                    </span>
                </div>
                <div class="item-control">
                    <div class="d-none d-md-flex flex-row">
                        <!--button class="btn btn-outline-primary rounded-0 border-right-0"
                                onclick="window.location.assign('{{ route('manage_single_book', ['book' => $book, '#book_info']) }}')"
                        >
                            Редактировать
                        </button-->
                        <button class="btn btn-outline-danger rounded-0"
                                onclick="deleteBook({{ $book->book_id }}, this)"
                        >Удалить</button>
                    </div>
                    <div class="d-md-none d-flex flex-row">
                        <!--button
                                class="btn btn-outline-primary border-right-0 rounded-0"
                                onclick="window.location.assign('{{ route('manage_single_book', ['book' => $book, '#book_info']) }}')"
                        >Ред.</button-->
                        <button
                                class="btn btn-outline-danger rounded-0"
                                onclick="deleteBook({{ $book->book_id }}, this)"
                        >Удал.</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <form action="{{ route('add_book') }}#book_info"  method="post" enctype="multipart/form-data">
        <div class="container form-group card p-4">
            <h2 id="book_info" class="text-center pb-3">
                {{ isset($choosen_book) ? 'Изменение книги' : 'Добавление книги' }} 
            </h2>
            <div class="mb-3">
                <label class="mb-0" style="font-size: 25px">Название</label>
                <input
                    type="text"
                    class="@error('title') is-invalid @enderror form-control"
                    name="title"
                    placeholder=""
                    value="{{ $choosen_book->title ?? old('title') }}">
            </div>
            <div class="mb-1">
                <label class="mb-0" style="font-size: 25px">
                    Автор<div class="btn ml-2 px-3 py-0 btn-outline-primary" onClick="{$('#author-for-copy').clone().removeAttr('id').insertAfter('#author-for-copy')}">+</div>
                </label>
                @foreach( old('authors_id') ?? [0] as $selectedAuthor )
                <select class="@error('authors_id.0') is-invalid @enderror form-control mb-2" name="authors_id[]" id="author-for-copy">
                    @foreach( $authors as $author )
                        <option
                            @if ($author->author_id == $selectedAuthor)
                                selected
                            @endif
                            value="{{ $author->author_id }}">
                            {{ $author->fullname }}
                        </option>
                    @endforeach
                </select>
                @endforeach
            </div>
            <div class="mb-1">
                <label class="mb-0" style="font-size: 25px">
                    Переводчик<div class="btn ml-2 px-3 py-0 btn-outline-primary" onClick="{$('#translator-for-copy').clone().removeAttr('id').insertAfter('#translator-for-copy')}">+</div>
                </label>
                @foreach( old('translators_id') ?? [-1] as $selectedTranslator )
                <select class="form-control mb-2" name="translators_id[]" id="translator-for-copy">
                    <option name="" value="-1">Отсутствует</option>
                    @foreach( $translators as $translator )
                        <option
                            @if ($translator->translator_id == $selectedTranslator)
                                selected
                            @endif
                            value="{{ $translator->translator_id }}">
                            {{ $translator->fullname }}
                            
                        </option>
                    @endforeach
                </select>
                @endforeach
            </div>
            <div class="row">
                <div class="col-sm d-flex flex-column justify-content-between">
                    <label class="mb-0" style="font-size: 25px">Категория</label>
                    <select class="mb-3 form-control" name="category_id">
                        @foreach( $categories as $category )
                            <option
                                @if(
                                    ($choosen_book->category_id ?? old('category_id')) == $category->category_id 
                                )
                                    selected 
                                @endif
                                value="{{ $category->category_id }}">
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm d-flex flex-column justify-content-between">
                    <label class="mb-0" style="font-size: 25px">Издательская серия</label>
                    <select class="mb-3 form-control" name="seria_id">
                        <option name="" value="-1">Отсутствует</option>
                        @foreach( $series as $seria )
                            <option
                                @if(
                                    ($choosen_book->seria_id ?? old('seria_id')) == $seria->seria_id 
                                )
                                    selected 
                                @endif
                                value="{{ $seria->seria_id }}">{{ $seria->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <label class="mb-0" style="font-size: 25px">Авторский цикл</label>
                    <select class="mb-3 form-control" name="cycle_id">
                        <option name="" value="-1">Отсутствует</option>
                        @foreach( $cycles as $cycle )
                            <option
                                @if(
                                    ($choosen_book->cycle_id ?? old('cycle_id')) == $cycle->cycle_id 
                                )
                                    selected 
                                @endif
                                value="{{ $cycle->cycle_id }}">{{ $cycle->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm">
                    <label class="mb-0" style="font-size: 25px">Номер в цикле</label>
                    <input
                        type="text"
                        class="mb-3 form-control"
                        name="number_in_cycle"
                        placeholder=""
                        value="{{ $choosen_book->number_in_cycle ?? old('number_in_cycle') }}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <label class="mb-0" style="font-size: 25px">Путь к обложке</label>
                    <input
                        type="file"
                        class="@error('cover_image') is-invalid @enderror mb-3 form-control"
                        name="cover_image"
                        accept="*.*"
                    >
                </div>
                <div class="col-sm">
                    <label class="mb-0" style="font-size: 25px">Тип обложки</label>
                    <select class="mb-3 form-control" name="cover_type">
                        <option value="мягкий">Мягкая</option>
                        <option value="твёрдый">Твёрдая</option>
                    </select>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm">
                    <label class="mb-0" style="font-size: 25px">ISBN</label>
                    <input
                        type="text"
                        class="mb-3 form-control"
                        name="isbn"
                        placeholder=""
                        value="{{ $choosen_book->isbn ?? old('isbn') }}">
                </div>
                <div class="col-sm">
                    <label class="mb-0" style="font-size: 25px">УДК</label>
                    <input
                        type="text"
                        class="mb-3 form-control"
                        name="ydk"
                        placeholder=""
                        value="{{ $choosen_book->ydk ?? old('ydk') }}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm d-flex flex-column justify-content-between">
                    <label class="mb-0" style="font-size: 25px">ББК</label>
                    <input
                        type="text"
                        class="mb-3 form-control"
                        name="bbk"
                        placeholder=""
                        value="{{ $choosen_book->bbk ?? old('bbk') }}">
                </div>
                <div class="col-sm d-flex flex-column justify-content-between">
                    <label class="mb-0" style="font-size: 25px">Возраст</label>
                    <input
                        type="text"
                        class="mb-3 form-control"
                        name="age_restriction"
                        placeholder=""
                        value="{{ $choosen_book->age_restriction ?? old('age_restriction') }}">
                </div>
                <div class="col-sm d-flex flex-column justify-content-between">
                    <label class="mb-0" style="font-size: 25px">Общий тираж</label>
                    <input
                        type="text"
                        class="mb-3 form-control"
                        name="tiraj"
                        placeholder=""
                        value="{{ $choosen_book->tiraj ?? old('tiraj') }}">
                </div>
                <div class="col-sm d-flex flex-column justify-content-between">
                    <label class="mb-0" style="font-size: 25px">Статус</label>
                    <input
                        type="text"
                        class="mb-3 form-control"
                        name="status"
                        placeholder=""
                        value="{{ $choosen_book->status ?? old('status') }}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm d-flex flex-column justify-content-between">
                    <label class="mb-0" style="font-size: 25px">Формат</label>
                    <select class="mb-3 form-control" name="format_id">
                        @foreach( $formats as $format )
                            <option value="{{ $format->format_id }}">{{ $format->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm d-flex flex-column justify-content-between">
                    <label class="mb-0" style="font-size: 25px">Год выпуска</label>
                    <input
                        type="text"
                        class="mb-3 form-control"
                        name="publish_date"
                        placeholder=""
                        value="{{ $choosen_book->publish_date ?? old('publish_date') }}">
                </div>
                <div class="col-sm d-flex flex-column justify-content-between">
                    <label class="mb-0" style="font-size: 25px">Кол-во страниц</label>
                    <input
                        type="text"
                        class="mb-3 form-control"
                        name="page_count"
                        placeholder=""
                        value="{{ $choosen_book->page_count ?? old('page_count') }}">
                </div>
                <div class="col-sm d-flex flex-column justify-content-between">
                    <label class="mb-0" style="font-size: 25px">Вес</label>
                    <input
                        type="text"
                        class="mb-3 form-control"
                        name="weight"
                        placeholder=""
                        value="{{ $choosen_book->weight ?? old('weight') }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="mb-0" style="font-size: 25px">Аннотация</label>
                <textarea
                    type="text"
                    class="form-control"
                    name="description"
                    placeholder="" >
                        {{ $choosen_book->description ?? old('description') }}
                </textarea>
            </div>
            <div class="row mb-3">
                <div class="col-sm">
                    <div class="form-check mb-2">
                        <input
                                style="height: 28px; width: 20px;"
                                name="is_bestseller"
                                class="form-check-input"
                                type="checkbox"
                                id="bestCheck"
                                {{ ($choosen_book->is_bestseller ?? old('is_bestseller')) ? 'checked' : '' }}
                        >
                        <label class="mb-0 pl-3 form-check-label" style="font-size: 25px" for="bestCheck">Бестселлер</label>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-check mb-2">
                        <input
                                style="height: 28px; width: 20px;"
                                name="is_shown"
                                class="form-check-input"
                                type="checkbox"
                                id="shownCheck"
                                {{ ($choosen_book->is_shown ?? old('is_shown')) ? 'checked' : '' }}
                        >
                        <label class="mb-0 pl-3 form-check-label" style="font-size: 25px" for="shownCheck">Отображать</label>
                    </div>
                </div>
                <div class="col-sm"></div>
                <div class="col-sm"></div>
            </div>

            <div class="mt-2 text-center">
                <button
                    href="#book_info"
                    class="btn btn-light"
                    style="font-size: 20px">
                    Добавить
                </button>
            </div>

        </div> 
    </form>
</div>
@endsection
