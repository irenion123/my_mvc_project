<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request as Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthPageController extends Controller
{

    public function index($viewParameters = null)
    {
        if ($viewParameters !== null) {
            return view('auth_page', $viewParameters);
        }
        return view('auth_page');
    }

    public function auth()
    {

        $action = request('action');

        if ($action == 'sign_up') {
            return $this->signUp();
        } else if ($action == 'sign_in') {
            return $this->singIn();
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        return redirect('/');
    }

    public function signUp()
    {
        $username = request('username');
        $birthday = request('birthday');
        $email = request('email');
        $password = request('password');
        $passwordConf = request('password_conf');

        $errors = [];

        $currentDate = new \DateTime();
        $currentDate->modify('-1 day');
        /**
         * @var DateTime
         */
        $birthdayDate = new \DateTime($birthday);
        $isBirthdayValid = $currentDate > $birthdayDate;
        if (!$isBirthdayValid) $errors[] = 'Дата рождения не может быть в будущем';

        $emailIsFree = empty(
            DB::table('users')
                ->where('email', $email)
                ->first()
        );

        if (!$emailIsFree) $errors[] = 'Введённый почтовый адрес уже используется';

        if ($password != $passwordConf) $errors[] = 'Пароли не совпадают';

        if (count($errors) > 0) {
            return $this->index([
                'action' => 'sign_up',
                'sign_up' => [
                    'email' => $email,
                    'password' => $password,
                    'password_conf' => $passwordConf,
                    'username' => $username,
                    'birthday' => $birthday,
                    'errors' => $errors,
                ]
            ]);
        }

        $userId = DB::table('users')->insertGetId([
            'username' => $username,
            'birthday' => $birthday,
            'email' => $email,
            'password' => Hash::make($password),
            'salt' => 'not used',
        ]);
        Auth::loginUsingId($userId);
        return redirect()->route('home');
    }

    public function singIn()
    {
        $email = request('email');
        $password = request('password');

        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            request()->session()->regenerate();
            return redirect()->route('home');
        } else {
            return $this->index([
                'action' => 'sign_in',
                'sign_in' => [
                    'email' => $email,
                    'password' => $password,
                    'errors' => [
                        'Пользователь с такой комбинацией почты и пароля не найден'
                    ],
                ]
            ]);
        }
    }

}
