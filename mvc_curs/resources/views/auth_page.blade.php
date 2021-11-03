@extends('main_blank')

@section('main')
<div class="container form-group card mt-5 p-4 col-md-4 col-8">
    <form action="{{ route('auth') }}" method="post">
        <div class="" id="sign_in_form" style="@if (($action ?? 'sign_in') != 'sign_in') display: none; @endif ">
            <h2 class="text-center pb-3">
                Вход/<a href="#" onclick="showSignUp()">Регистрация</a>
            </h2>
            <div class="">
                @foreach ( $sign_in['errors'] ?? [] as $error )
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            </div>
            <div class="" id="reg-form">
                <div>
                    <label style="font-size: 25px">E-mail</label>
                    <input type="email"
                           class="form-control"
                           name="email"
                           placeholder="Введите e-mail"
                           required
                           value="{{ $sign_in['email'] ?? '' }}"
                    > 
                </div>

                <div>
                    <label style="font-size: 25px">Пароль</label>
                    <input type="password"
                           class="form-control"
                           name="password"
                           placeholder="Введите пароль"
                           required
                           value="{{ $sign_in['password'] ?? '' }}"
                    > 
                </div>
            
            </div>
            <div class="mt-4 text-center">
                <button class="btn btn-light" type="submit" name="action" value="sign_in" style="font-size: 20px">
                    Войти
                </button>
            </div>
        </div>
    </form>
    <form action="{{ route('auth') }}" method="POST">
        <div class="" id="sign_up_form" style="@if (($action ?? '') != 'sign_up') display: none; @endif">
            <h2 class="text-center pb-3">
                <a href="#" onclick="showSignIn()">Вход</a>/Регистрация
            </h2>
            <div class="">
                @foreach ( $sign_up['errors'] ?? [] as $error )
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            </div>
            <div class="" id="reg-form">
                <div class="row" id="reg-form">
                    <div class="col-sm">
                        <label style="font-size: 25px">Имя</label>
                        <input type="text"
                               class="form-control"
                               name="username"
                               placeholder="Введите Ваше имя"
                               required
                               value="{{ $sign_up['username'] ?? '' }}"
                        >
                    </div>
                    <div class="col-sm">
                        <label style="font-size: 25px">Дата рождения</label>
                        <input type="date"
                               class="form-control"
                               name="birthday"
                               required
                               value="{{ $sign_up['birthday'] ?? '' }}"
                        >
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-sm">
                        <label style="font-size: 25px">E-mail</label>
                        <input type="email"
                               class="form-control" name="email"
                               placeholder="Введите Вашу электронную почту"
                               required
                               value="{{ $sign_up['email'] ?? '' }}"
                        >
                        <small class="form-text text-muted">Мы никогда не сообщим Ваш адрес электронной почты кому-либо.</small>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-sm">
                        <label style="font-size: 25px">Пароль</label>
                        <input type="password"
                               class="form-control"
                               name="password"
                               placeholder="Введите пароль"
                               required
                               value="{{ $sign_up['password'] ?? '' }}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <label style="font-size: 25px">Повторите пароль</label>
                        <input type="password"
                               class="form-control"
                               name="password_conf"
                               placeholder="Повторите пароль"
                               required
                               value="{{ $sign_up['password_conf'] ?? '' }}"
                        > 
                    </div>
                </div>
            
            </div>
            <div class="mt-4 text-center">
                <button class="btn btn-light" type="submit" name="action" value="sign_up" style="font-size: 20px">
                    Зарегистрироваться
                </button>
            </div>
        </div>
    </form>
</div> 
<script>
function showSignIn()
{
    $('#sign_up_form').hide();
    $('#sign_in_form').show();
}
function showSignUp()
{
    $('#sign_in_form').hide();
    $('#sign_up_form').show();
}
</script>
</form>
@endsection
