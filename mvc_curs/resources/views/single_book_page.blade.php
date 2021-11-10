@extends('main')

@section('main')
<div class="mt-5 container">
    <div class="row">
        <!-- Картинка -->
        <div class="col-lg-6 col-12">
            <div class="book-image" style="background: url('{{ asset($book['cover_image']) }}'); background-size: contain; background-position: center;"></div>
            <div class="mt-2 text-center">
                <div class="btnmar">
                    @if (Auth::check())
                        @if (in_array($book['book_id'], Auth::user()->reservedBooks))
                            <button class="btn btn-light pl-5 pr-5 mt-3" onclick="removeReservation('{{ $book->book_id }}', this)">Убрать</button>
                        @else
                            <button class="btn btn-light pl-5 pr-5 mt-3" onclick="addReservation('{{ $book->book_id }}', this)">Отложить</button>
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
            <div class="indent d-flex flex-column" style="font-size:20px">
                <table class="table table-bordered custom-table">
                    @isset($book->translator_name) <tr><td><p class="mb-0">Переводчик(и)</td><td> {{ $book->translator_name }}           </td></tr> @endisset
                    @isset($book->category_name)   <tr><td><p class="mb-0">Категория</td><td> {{ $book->category_name }}                 </td></tr> @endisset
                    @isset($book->seria_name)      <tr><td><p class="mb-0">Издательская серия</td><td> {{ $book->seria_name }}           </td></tr> @endisset
                    @isset($book->cycle_name)      <tr><td><p class="mb-0">Цикл</td><td> {{ $book->cycle_name }}                         </td></tr> @endisset

                    @isset($book->number_in_cycle) <tr><td><p class="mb-0">Номер в цикле</td><td> {{ $book->number_in_cycle }}           </td></tr> @endisset
                    @isset($book->status)          <tr><td><p class="mb-0">Статус</td><td> {{ $book->status }}                           </td></tr> @endisset
                    @isset($book->isbn)            <tr><td><p class="mb-0">ISBN</td><td> {{ $book->isbn }}                               </td></tr> @endisset
                    @isset($book->ydk)             <tr><td><p class="mb-0">YDK</td><td> {{ $book->ydk }}                                 </td></tr> @endisset
                    @isset($book->bbk)             <tr><td><p class="mb-0">BBK</td><td> {{ $book->bbk }}                                 </td></tr> @endisset
                    @isset($book->publish_date)    <tr><td><p class="mb-0">Год публикации</td><td> {{ $book->publish_date }}             </td></tr> @endisset
                    @isset($book->page_count)      <tr><td><p class="mb-0">Кол-во страниц</td><td> {{ $book->page_count }}               </td></tr> @endisset
                    @isset($book->format_name)     <tr><td><p class="mb-0">Формат</td><td> {{ $book->format_name }}                      </td></tr> @endisset
                    @isset($book->weight)          <tr><td><p class="mb-0">Вес</td><td> {{ $book->weight }} кг                           </td></tr> @endisset
                    @isset($book->age_restriction) <tr><td><p class="mb-0">Возр. ограничение</td><td> {{ $book->age_restriction }}+ </td></tr> @endisset
                    @isset($book->tiraj)           <tr><td><p class="mb-0">Тираж</td><td> {{ $book->tiraj }} шт.                         </td></tr> @endisset
                    @isset($book->cover_type)      <tr><td><p class="mb-0">Тип обложки</td><td> {{ $book->cover_type }}                  </td></tr> @endisset
                </table>
            </div>
            
        </div>
    </div>
</div>
</div>
@endsection

