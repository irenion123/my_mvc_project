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
                <span class="mb-1" style="font-size: 25px">
                    <span class="">Автор</span>
                    <button
                        type="button"
                        class="btn btn-outline-primary px-3 py-0"
                        data-toggle="modal"
                        data-target="#modalAddAuthor">Создать</button>
                </span>
                @foreach( old('authors_id') ?? [0] as $selectedAuthor )
                <div class="input-group mb-2" id="author-for-copy">
                    <select class="@error('authors_id.0') is-invalid @enderror custom-select" name="authors_id[]" id="authorChooser">
                        @foreach( $authors as $author )
                            <option
                                @if ($author->author_id == $selectedAuthor)
                                    selected
                                @endif
                                value="{{ $author->author_id }}">
                                {{ $author->author_id }}. {{ $author->fullname }}
                            </option>
                        @endforeach
                    </select>
                    @if ($loop->first)
                    <div class="input-group-append" id="append-btn">
                        <button
                            class="btn btn-outline-secondary"
                            onClick="{
                                event.preventDefault()
                                copy = $('#author-for-copy')
                                    .clone()
                                    .removeAttr('id')
                                copy.find('#append-btn').remove()
                                copy.insertAfter('#author-for-copy')
                            }"
                        >Ещё один</button>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="mb-1">
                <span class="" style="font-size: 25px">
                    <span class="">Переводчик</span>
                    <button
                        type="button"
                        class="btn btn-outline-primary px-3 py-0"
                        data-toggle="modal"
                        data-target="#modalAddTranslator">Создать</button>
                </span>
                @foreach( old('translators_id') ?? [0] as $selectedTranslator )
                <div class="input-group mb-2" id="translator-for-copy">
                    <select class="custom-select" name="translators_id[]" id="translatorChooser">
                        <option value="-1">Отсутствует</option>
                        @foreach( $translators as $translator )
                            <option
                                @if ($translator->translator_id == $selectedTranslator)
                                    selected
                                @endif
                                value="{{ $translator->translator_id }}">
                                {{ $translator->translator_id }}. {{ $translator->fullname }}
                            </option>
                        @endforeach
                    </select>
                    @if ($loop->first)
                    <div class="input-group-append" id="append-btn">
                        <button
                            class="btn btn-outline-secondary"
                            onClick="{
                                event.preventDefault()
                                copy = $('#translator-for-copy')
                                    .clone()
                                    .removeAttr('id')
                                copy.find('#append-btn').remove()
                                copy.insertAfter('#translator-for-copy')
                            }"
                        >Ещё один</button>
                    </div>
                    @endif
                </div>
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
                    <label class="mb-0" style="font-size: 25px">Обложка</label>
                    <input
                        type="file"
                        class="@error('cover_image') is-invalid @enderror form-control-file mb-3 p-0 py-1 pl-1 border rounded"
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
                                {{ ($choosen_book->is_shown ?? old('is_shown')) ?? 'checked' }}
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
<script>
function modalAddAuthor()
{
    fullName = $('#modalAuthorFullName')[0].value.trim();
    if (fullName.length < 1) return;
    addAuthor(fullName)
        .then( (data) => {
        $('#modalAddAuthor').modal('hide');
        $('#modalAuthorFullName')[0].value = ''
        $('#authorChooser').append("<option value=" + data.id + ">" + data.id + ". " + fullName + "</option>")
    })
        .catch( (error) => {
        console.log(error)
    } )
}
function modalAddTranslator()
{
    fullName = $('#modalTranslatorFullname')[0].value.trim();
    if (fullName.length < 1) return;
    addTranslator(fullName)
        .then( (data) => {
        $('#modalAddTranslator').modal('hide');
        $('#modalTranslatorFullname')[0].value = '';
        $('#translatorChooser').append("<option value=" + data.id + ">" + data.id + ". " + fullName + "</option>")
    })
        .catch( (error) => {
        console.log(error)
    } )
}
</script>

<!-- Модалка добавления автора -->
<div class="modal fade" id="modalAddAuthor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Добавление автора</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="mb-0">Фамилия Имя Отчество</label>
                    <input
                        id="modalAuthorFullName"
                        type="text"
                        class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="modalAddAuthor()"
                >Добавить</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddTranslator" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Добавление переводчика</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="mb-0">Фамилия Имя Отчество</label>
                    <input
                        id="modalTranslatorFullname"
                        class="form-control"
                        type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="modalAddTranslator()"
                >Добавить</button>
            </div>
        </div>
    </div>
</div>
@endsection
