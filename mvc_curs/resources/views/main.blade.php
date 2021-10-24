<!DOCTYPE html>
<html lang="ru_RU">
    <head>

        <meta charset="utf-8">
        <title>@yield('title', 'Книги.ру')</title>

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
        @yield('main')
        </div>
        @include('footer')
        <script>
            function footerToBottom() {
                var browserHeight = $(window).height(),
                    footerOuterHeight = $(".footer").outerHeight(true),
                    mainHeightMarginPaddingBorder =
                        $(".main").outerHeight(true) - $(".main").height();
                $(".main").css({
                    "min-height":
                        browserHeight -
                        footerOuterHeight -
                        mainHeightMarginPaddingBorder,
                });
            }
            footerToBottom();
            $(window).resize(function () {
                footerToBottom();
            });
        </script>
    </body>
</html>


