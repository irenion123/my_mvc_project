@extends('main')

@section('main')
<div class="container mt-4" id="cont">
    <div class="container mt-4" id="cont">
        <div class="row align-items-center" style="text-align: center;">    
            <div class="col-lg-6 col-12 align-middle" style="text-align: left;">
                <div class="contel">
                    <div class="author_text" style="text-indent: 20px">
                        <p> Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam </p>
                        <p>  Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint </p>
                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    </div>
                </div>
            </div> 
            <!-- Карта -->
            <div class="col-lg-6 col-12 align-middle">
                <img src="{{ asset('imgs/slider/biblioteka.png') }}" width="550" alt="Фото нашей библиотеки">
            </div>

        </div>
    </div>

    <div>
        <form action="cont.php" method="post">
            <h4>Используйте форму ниже, чтобы связаться с нами: </h4>
            <div class="container form-group card p-4">
                <div class="row" id="reg-form">
                    <div class="col-md-6 col-12">
                        <label style="font-size: 25px">Ваше имя:</label>
                        <input type="text" class="form-control" name="name" placeholder="Введите Ваше имя" required> 
                    </div>
                    <div class="col-md-6 col-12">
                        <label style="font-size: 25px">Ваша электронная почта:</label>
                        <input type="email" class="form-control" name="email" placeholder="Введите Вашу почту" required>
                    </div>
                    <div class="col-md-12 col-12">
                        <label style="font-size: 25px">Ваше сообщение:</label>
                        <textarea class="form-control" name="message" rows="5" placeholder="Напишите свое сообщение" required></textarea>
                    </div>
                </div>
                <div class="mt-4 text-center"><input class="btn btn-light" name="send" type="submit" value="Отправить" style="font-size: 20px"></div>
            </div>
        </form>
    </div>

    <div class="row align-items-center" style="text-align: center;">    
        <!-- Карта -->
        <div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/org/redaktsiya_bubble/1213856643/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Редакция Bubble</a><a href="https://yandex.ru/maps/213/moscow/category/mass_media_offices/184107401/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:14px;">Редакция СМИ в Москве</a><iframe src="https://yandex.ru/map-widget/v1/-/CCUu46C59A" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
        <!-- Контактные данные -->
        <div class="col-lg-6 col-12 align-middle" style="text-align: left;">
            <div class="contel">
                <h4>Ленинградский просп., 15, стр. 12, Москва, Россия</h4>
                <h4>Часы работы:</h4>
                <div>Пн - Пт. 9:00 – 10:00</div>
                <h4>Контакты:</h4> 
                <div class="tel">+7 (900) 000-00-00</div>
                <a href="mailto:izdatelstvo@mail.ru">izdatelstvo@mail.ru</a>
            </div>
        </div> 
    </div>
</div>
@endsection
