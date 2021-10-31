@extends('main_blank')

@section('main')
<form action="auth.php"  method="post">
    <div class="container form-group card mt-5 p-4 col-md-4 col-8">
        <div class="" id="sign_in_form">
            <h2 class="text-center pb-3">
                Вход/<a href="#" onclick="showSignUp()">Регистрация</a>
            </h2>
            <div class="" id="reg-form">
                <div>
                    <label style="font-size: 25px">E-mail</label>
                    <input type="email" class="form-control" name="email" placeholder="Введите e-mail" required> 
                </div>
            
                <div>
                    <label style="font-size: 25px">Пароль</label>
                    <input type="password" class="form-control" name="password" placeholder="Введите пароль" required> 
                </div>
            
            </div>
            <div class="mt-4 text-center">
                <button class="btn btn-light" type="submit" name="action" value="auth" style="font-size: 20px">
                    Войти
                </button>
            </div>
        </div>
        <div class="" id="sign_up_form" style="display: none;">
            <h2 class="text-center pb-3">
                <a href="#" onclick="showSignIn()">Вход</a>/Регистрация
            </h2>
            <div class="" id="reg-form">
                <div>
                    <label style="font-size: 25px">E-mail</label>
                    <input type="email" class="form-control" name="email" placeholder="Введите e-mail" required> 
                </div>
            
                <div>
                    <label style="font-size: 25px">Пароль</label>
                    <input type="password" class="form-control" name="password" placeholder="Введите пароль" required> 
                </div>
            
            </div>
            <div class="mt-4 text-center">
                <button class="btn btn-light" type="submit" name="action" value="auth" style="font-size: 20px">
                    Зарегистрироваться
                </button>
            </div>
        </div>
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
