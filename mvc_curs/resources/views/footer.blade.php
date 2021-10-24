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
                                href="index.php"
                                style="margin-bottom: 0rem"
                                >Главная</a
                            >
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-9 align-middle">
                            <a
                                class="foot"
                                href="catalog.php"
                                style="margin-bottom: 0rem"
                                >Каталог</a
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
                                href="authors.php"
                                style="margin-bottom: 0rem"
                                >Авторы</a
                            >
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-9 align-middle">
                            <a
                                class="foot"
                                href="cont.php"
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
