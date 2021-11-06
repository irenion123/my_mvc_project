@extends('main')

@section('main')
<div class="container">
    <div class="row">
        <!-- Картинка -->
        <div class="col-lg-6 col-12">
            <div class="book-image" style="background: url('{{ asset($book['cover_image']) }}'); background-size: contain; background-position: center;"></div>
            <div class="mt-2 text-center">
                <div class="btnmar">
                    @if (Auth::check())
                        @if (in_array($book['book_id'], Auth::user()->reservedBooks))
                            <button class="btn btn-light pl-5 pr-5 mt-3" onclick="removeReservation('<?= $book["id_Book"] ?>', this)">Убрать</button>
                        @else
                            <button class="btn btn-light pl-5 pr-5 mt-3" onclick="addReservation('<?= $book["id_Book"] ?>', this)">Отложить</button>
                        @endif
                    @else
                        <a href="/sign_in.php" class="btn btn-light">Отложить</a>
                    @endif
                </div>
            </div>
        </div>  
        <!-- Описание книги -->
        <div class="col-lg-6 col-12 name-prepod mt-3 mb-3">
            @isset($book->title) <p style="font-size: 30px;">Название: {{ $book->title }}<br></p> @endisset
            @isset($book->author_name) <p style="font-size: 30px;">Автор(ы): {{ $book->author_name }}<br></p> @endisset
            <p align="center">Аннотация:<br></p>
                @isset($book->description) <p class="indent" style="font-size:16px;">{{ $book->description }}<br></p> @endisset
            <p align="center">Характеристики:<br></p>
            <div class="indent" style="font-size:20px;">
                @isset($book->translator_name) <p style="font-size: 30px;">Переводчик(и): {{ $book->translator_name }}<br></p> @endisset
                @isset($book->isbn) <p style="font-size: 30px;">ISBN: {{ $book->isbn }}<br></p> @endisset
                @isset($book->ydk) <p style="font-size: 30px;">YDK: {{ $book->ydk }}<br></p> @endisset
                @isset($book->bbk) <p style="font-size: 30px;">BBK: {{ $book->bbk }}<br></p> @endisset
                @isset($book->category_name) <p style="font-size: 30px;">Категория: {{ $book->category_name }}<br></p> @endisset
                @isset($book->seria_name) <p style="font-size: 30px;">Издательская серия: {{ $book->seria_name }}<br></p> @endisset
                
                <?php if (!empty($book['CycTitle'])) {?> <p>Цикл: <?= $book['CycTitle']?></p> <?php } ?>
                <?php if (!empty($book['CycTitle'])&&!empty($book['Number_in_Cycle'])) {?> <p>Номер в цикле: <?= $book['Number_in_Cycle']?></p> <?php } ?>
                <?php if (!empty($book['Year'])) {?> <p>Год выпуска: <?= $book['Year']?></p> <?php } ?>
                <?php if (!empty($book['Width'])&&!empty($book['Height'])) {?> <p>Формат: <?= $book['Width']?>x<?= $book['Height']?></p> <?php } ?>
                <?php if (!empty($book['Number_of_pages'])) {?> <p>Кол-во страниц: <?= $book['Number_of_pages']?></p> <?php } ?>
                <?php if (!empty($book['Weight'])) {?> <p>Вес: <?= $book['Weight']?></p> <?php } ?>
                <?php if (!empty($book['Age'])) {?> <p>Возрастное ограничение: <?= $book['Age']?>+</p> <?php } ?>
                <?php if (!empty($book['Сirculation'])) {?> <p>Общий тираж: <?= $book['Сirculation']?>  </p> <?php } ?>
                <?php if (!empty($book['Status'])) {?> <p>Статус: <?= $book['Status']?>  </p> <?php } ?>
            </div>
            
        </div>
    </div>
</div>
</div>
@endsection

