<header id="header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <!-- Логотип -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img
                class="p-2"
                src="{{ asset('icons/logo_rectangle.png') }}"
                style="width: 125px; margin: 0px; border: 0px"
            />
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbar1"
            aria-controls="navbar1"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="col collapse navbar-collapse text-center" id="navbar1">
            <!-- Меню -->
            <ul class="navbar-nav mr-auto hr">
                <li class="lnk-item p-0">
                    <a class="lnk-link px-2" href="{{ route('home') }}">Главная</a>
                </li>
                <li class="lnk-item p-0">
                    <a class="lnk-link px-2" href="{{ route('books') }}">Книги</a>
                </li>
                <li class="lnk-item p-0">
                    <a class="lnk-link px-2" href="{{ route('authors') }}">Авторы</a>
                </li>
                <li class="lnk-item p-0">
                    <a class="lnk-link px-2" href="{{ route('contacts') }}">Контакты</a>
                </li>

                @if (Auth::check() && Auth::user()['is_admin'] === 1)
                <li class="lnk-item p-0">
                    <a
                        class="lnk-link px-2"
                        href="{{ route('manage_books') }}"
                        >Администрирование</a
                    >
                </li>
                @endif
            </ul>
            <ul class="navbar-nav">
                <li class="lnk-item">
                    @if (Auth::check())
                    <a class="lnk-link px-2" href="{{ route('profile') }}">Профиль</a>
                    @else 
                    <a class="lnk-link px-2" href="{{ route('auth') }}" >Вход/Регистрация</a>
                    @endif
                </li>
            </ul>

        </div>
    </nav>
</header>
