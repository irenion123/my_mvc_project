<footer class="footer">
    <div class="container-fluid py-2">
        <div class="container">
            <div class="row my-2 align-items-center">
                <div class="col-md-2">
                    <div class="row align-items-center">
                        <div class="col-lg-9 align-middle">
                            <a class="foot" href="{{ route('home') }}">Главная</a>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-9 align-middle">
                            <a class="foot" href="{{ route('books') }}">Книги</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="row align-items-center">
                        <div class="col-lg-9 align-middle">
                            <a class="foot" href="{{ route('authors') }}">Авторы</a>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-9 align-middle">
                            <a class="foot" href="{{ route('contacts') }}">Контакты</a>
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
                                        src="{{ asset('icons/inst.png') }}"
                                        style="width: 35px; margin-right: 6px"
                                /></a>
                                <a href="#"
                                    ><img
                                        src="{{ asset('icons/fcbk.png') }}"
                                        style="width: 35px; margin-right: 6px"
                                /></a>
                                <a href="#"
                                    ><img
                                        src="{{ asset('icons/whtspp.png') }}"
                                        style="width: 37px; margin-right: 5px"
                                /></a>
                                <a href="#"
                                    ><img src="{{ asset('icons/vk.png') }}" style="width: 37px"
                                /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
