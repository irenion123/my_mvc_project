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
                    <span class="mb-0" style="font-size: 25px">
                        <span class="">Категория</span>
                        <button
                            type="button"
                            class="btn btn-outline-primary px-3 py-0"
                            data-toggle="modal"
                            data-target="#modalAddCategory">Создать</button>
                    </span>
                    <select class="mb-3 form-control" name="category_id" id="categoryChooser">
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
                    <span class="mb-0" style="font-size: 25px">
                        <span class="">Издательская серия</span>
                        <button
                            type="button"
                            class="btn btn-outline-primary px-3 py-0"
                            data-toggle="modal"
                            data-target="#modalAddSeria">Создать</button>
                    </span>
                    <select class="mb-3 form-control" name="seria_id" id="seriaChooser">
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
                    <span class="mb-0" style="font-size: 25px">
                    <span class="">Авторский цикл</span>
                        <button
                            type="button"
                            class="btn btn-outline-primary px-3 py-0"
                            data-toggle="modal"
                            data-target="#modalAddCycle">Создать</button>
                    </span>
                    <select class="mb-3 form-control" name="cycle_id" id="cycleChooser">
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
                        class="@error('cover_image') is-invalid border-danger @enderror form-control-file mb-3 p-0 py-1 pl-1 border rounded"
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
                    <span class="mb-0" style="font-size: 25px">
                        <span class="">Формат</span>
                        <button
                            type="button"
                            class="btn btn-outline-primary px-3 py-0"
                            data-toggle="modal"
                            data-target="#modalAddFormat">Создать</button>
                    </span>
                    <select class="mb-3 form-control" name="format_id" id="formatChooser">
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
<script>
function modalAddAuthor()
{
    fullName = $('#modalAuthorFullName')[0].value.trim();
    if (fullName.length < 1) return;
    addAuthor(fullName)
        .then( (data) => {
        $('#modalAddAuthor').modal('hide');
        $('#modalAuthorFullName')[0].value = ''
        $('#authorChooser').append("<option value=" + data.id + " selected>" + data.id + ". " + fullName + "</option>")
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
        $('#translatorChooser').append("<option value=" + data.id + " selected>" + data.id + ". " + fullName + "</option>")
    })
        .catch( (error) => {
        console.log(error)
    } )
}
function modalAddCategory()
{
    title = $('#modalCategoryTitle')[0].value.trim();
    titleEng = $('#modalCategoryTitleEng')[0].value.trim();
    addCategory(title, titleEng)
        .then( (response) => {
        if (response.data) {
            $('#modalAddCategory').modal('hide');
            $('#modalCategoryTitle')[0].value = '';
            $('#modalCategoryTitleEng')[0].value = '';
            $('#categoryChooser').append("<option value=" + response.id + " selected>" + title + "</option>")
            $('#modalAddCategoryErrors').addClass('d-none');
            $('#modalAddCategoryErrors').empty();
        } else {
            console.error(response);
            $('#modalAddCategoryErrors').removeClass('d-none');
            $('#modalAddCategoryErrors').empty();
            for (var k in response.errors) {
                $('#modalAddCategoryErrors').append(
                    '<span>' + response.errors[k] + '</span>'
                )
            }
        }  
    })
        .catch( (error) => {
        console.log(error)
    } )
}
function modalAddSeria()
{
    title = $('#modalSeriaTitle')[0].value.trim();
    addSeria(title)
        .then( (response) => {
        if (response.data) {
            $('#modalAddSeria').modal('hide');
            $('#modalSeriaTitle')[0].value = '';
            $('#seriaChooser').append("<option value=" + response.data.id + " selected>" + title + "</option>")
            $('#modalAddSeriesErrors').addClass('d-none');
            $('#modalAddSeriesErrors').empty();
        } else {
            console.error(response);
            $('#modalAddSeriesErrors').removeClass('d-none');
            $('#modalAddSeriesErrors').empty();
            for (var k in response.errors) {
                $('#modalAddSeriesErrors').append(
                    '<span>' + response.errors[k] + '</span>'
                )
            }
        }
    })
        .catch( (error) => {
        console.log(error)
    } )
}
function modalAddCycle()
{
    title = $('#modalCycleTitle')[0].value.trim();
    addCycle(title)
        .then( (response) => {
        if (response.status) {
            $('#modalAddCycle').modal('hide');
            $('#modalCycleTitle')[0].value = '';
            $('#cycleChooser').append("<option value=" + response.data.id + " selected>" + title + "</option>");
            $('#modalAddCycleErrors').addClass('d-none');
        } else {
            console.error(response);
            $('#modalAddCycleErrors').removeClass('d-none');
            $('#modalAddCycleErrors').empty();
            for (var k in response.errors) {
                $('#modalAddCycleErrors').append(
                    '<span>' + response.errors[k] + '</span>'
                )
            }
        }
    })
        .catch( (error) => {
        console.log(error)
    } )
}
function modalAddFormat()
{
    width = $('#modalFormatWidth')[0].value.trim();
    height = $('#modalFormatHeight')[0].value.trim();
    if (width.length < 1) return;
    if (height.length < 1) return;
    addFormat(width, height)
        .then( (data) => {
        $('#modalAddFormat').modal('hide');
        $('#modalFormatWidth')[0].value = '';
        $('#modalFormatHeight')[0].value = '';
        $('#formatChooser').append("<option value=" + data.id + " selected>" + width + " x " + height + "</option>")
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
<div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Добавление категории</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div id="modalAddCategoryErrors" class="alert alert-danger d-none"></div>
                    <label class="mb-0">Название категории</label>
                    <input
                        id="modalCategoryTitle"
                        class="form-control"
                        type="text">
                </div>
                <div class="mb-3">
                    <label class="mb-0">Название категории на английском</label>
                    <input
                        id="modalCategoryTitleEng"
                        class="form-control"
                        type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="modalAddCategory()"
                >Добавить</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddSeria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Добавление серии</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div id="modalAddSeriesErrors" class="alert alert-danger d-none"></div>
                    <label class="mb-0">Название серии</label>
                    <input
                        id="modalSeriaTitle"
                        class="form-control"
                        type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="modalAddSeria()"
                >Добавить</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddCycle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Добавление цикла</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div id="modalAddCycleErrors" class="alert alert-danger d-none"></div>
                    <label class="mb-0">Название цикла</label>
                    <input
                        id="modalCycleTitle"
                        class="form-control"
                        type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="modalAddCycle()"
                >Добавить</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddFormat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Добавление формата</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="mb-0">Введите ширину</label>
                    <input
                        id="modalFormatWidth"
                        class="form-control"
                        type="text">
                </div>
                <div class="mb-3">
                    <label class="mb-0">Введите высоту</label>
                    <input
                        id="modalFormatHeight"
                        class="form-control"
                        type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="modalAddFormat()"
                >Добавить</button>
            </div>
        </div>
    </div>
</div>
@endsection
