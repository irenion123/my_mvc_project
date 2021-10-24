<!DOCTYPE html>
<html lang="ru_RU">
    <head>

        <meta charset="utf-8">
        <title>Сайт издательства</title>

        <link rel="stylesheet" href="{{ asset('css/main.css') }}"> <!-- Мои стили -->
        <!-- Бибдиотеки BOOTSTRAP и JQuery -->
        <link rel="stylesheet" href="{{ asset('bootstrap-4.2.1/css/bootstrap.css') }}">
        <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }} "></script>
        <script src="{{ asset('bootstrap-4.2.1/js/bootstrap.min.js') }}"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        @include('header')
        <div class="main">
            <div class="container mb-4 mt-4">
                 <h1>Читай. Люби. Развивайся.</h1>
            <!-- Слайдер -->
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img src="slider/1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="slider/2.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="slider/3.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <!-- Курсы -->
            <div class="container mb-4 mt-4">
                <h1>Наши бестселлеры.</h1></br>
                <div class="row">
                </div>
            </div>

            <div class="container mt-4">
                <div class="row align-items-center">    
                                            <!-- Контактные данные -->
                    <div class="col-lg-6 col-12 align-middle">
                        <div class="contel">
                            <p>Узнавай первым о новых книгах</p>
                            <p class="author_text">Все новинки, выпускаемые издательством, Вы сможете увидеть на нашем сайте. Мы будем писать вам раз в месяц о новинках в нашем магазине.</p>
                        </div>
                    </div> 

                    <!-- Карта -->
                    <div class="col-lg-6 col-12 align-middle">
                        <img src="slider/biblioteka.png" width="550">
                    </div>

                </div>
            </div>
        </div>
        @include('footer')
    </body>
</html>


