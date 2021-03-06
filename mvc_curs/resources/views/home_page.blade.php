@extends('main')

@section('main')
<div class="container mb-4 mt-4">
    <h1>
        <span class="accent-header">Читай.</span>
        <span class="accent-header">Вдохновляйся.</span>
        <span class="accent-header">Учись.</span>
    </h1>
    <!-- Слайдер -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="{{ asset('imgs/slider/1.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('imgs/slider/2.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('imgs/slider/3.jpg') }}" class="d-block w-100" alt="...">
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
    <h1 class="accent-header">Наши бестселлеры.</h1></br>
    <div class="row">
    @each('components.book', $bestSellers, 'book')
    </div>
</div>

<div class="container mt-4">
    <div class="row align-items-center">    
        <!-- Контактные данные -->
        <div class="col-lg-6 col-12 align-middle">
            <h3>Узнавай первым о новых книгах</h3>
            <p class="text-justify">Все новинки, выпускаемые издательством, Вы сможете увидеть на нашем сайте. Мы будем писать вам раз в месяц о новинках в нашем магазине.</p>
        </div> 
        <!-- Карта -->
        <div class="col-lg-6 col-12 align-middle">
            <img src="{{ asset('imgs/slider/biblioteka.png') }}" width="100%">
        </div>
    </div>
</div>
@endsection
