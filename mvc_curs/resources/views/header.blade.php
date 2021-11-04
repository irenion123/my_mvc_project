<header id="header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <!-- Логотип -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img
                class="logo2"
                src="{{ asset('icons/logo.png') }}"
                style="width: 100px; margin: 0px; border: 0px"
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
                <li class="dropdown">
                    <a
                        class="dropdown-toggle lnk-link px-2"
                        href="#"
                        id="asortiDropdown"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        >Администрирование</a
                    >
                    <div class="dropdown-menu" aria-labelledby="asortiDropdown">
                        <a class="dropdown-item" href="view_add_book.php"
                            >Добавить книгу</a
                        >
                        <a
                            class="dropdown-item"
                            href="view_add_author_transl.php"
                            >Добавить автора/переводчика</a
                        >
                        <a
                            class="dropdown-item"
                            href="view_add_cat_cyc_seria_form.php"
                            >Добавить категорию/цикл/серию/формат</a
                        >
                    </div>
                </li>
                @endif
            </ul>
            <ul class="p-0">
                <li class="lnk-item">
                    @if (Auth::check())
                    <a class="lnk-link px-2" href="profile.php">Профиль</a>
                    @else 
                    <a class="lnk-link px-2" href="{{ route('auth') }}" >Вход/Регистрация</a>
                    @endif
                </li>
            </ul>

        </div>
    </nav>
</header>
