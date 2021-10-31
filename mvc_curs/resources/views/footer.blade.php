<footer class="footer">
    <div class="container-fluid py-2">
        <div class="container">
            <div class="row my-2 align-items-center">
                <div class="col-md-2">
                    <div class="row align-items-center">
                        <div
                            class="col-lg-9 align-middle"
                            style="margin-bottom: 3px"
                        >
                            <a
                                class="foot"
                                href="{{ action([ App\Http\Controllers\HomePageController::class, 'index' ]) }}"
                                style="margin-bottom: 0rem"
                                >Главная</a
                            >
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-9 align-middle">
                            <a
                                class="foot"
                                href="{{ action([ App\Http\Controllers\BooksPageController::class, 'index' ]) }}"
                                style="margin-bottom: 0rem"
                                >Книги</a
                            >
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="row align-items-center">
                        <div
                            class="col-lg-9 align-middle"
                            style="margin-bottom: 3px"
                        >
                            <a
                                class="foot"
                                href="{{ action([ App\Http\Controllers\AuthorsPageController::class, 'index' ]) }}"
                                style="margin-bottom: 0rem"
                                >Авторы</a
                            >
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-9 align-middle">
                            <a
                                class="foot"
                                href="{{ action([ App\Http\Controllers\ContactsPageController::class, 'index' ]) }}"
                                style="margin-bottom: 0rem"
                                >Контакты</a
                            >
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row align-items-center justify-content-center">
                        <p
                            class="justify-content-center py-2"
                            style="
                                color: rgb(143, 143, 143);
                                margin-bottom: 0rem;
                            "
                        >
                            © Курсовой проект
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row justify-content-center">
                        <div class="d-inline-block">
                            <div>
                                <a href="#"
                                    ><img
                                        src="img/inst.png"
                                        style="width: 35px; margin-right: 6px"
                                /></a>
                                <a href="#"
                                    ><img
                                        src="img/fcbk.png"
                                        style="width: 35px; margin-right: 6px"
                                /></a>
                                <a href="#"
                                    ><img
                                        src="img/whtspp.png"
                                        style="width: 37px; margin-right: 5px"
                                /></a>
                                <a href="#"
                                    ><img src="img/vk.png" style="width: 37px"
                                /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
