<?php

namespace App\Forms\Auth;

use App\Fields\Checkbox;
use App\Fields\Email;
use App\Fields\Password;
use App\Forms\Form;
use Illuminate\Support\Facades\Route;

class LoginForm extends Form
{
    protected function method()
    {
        return 'post';
    }

    protected function action()
    {
        return route('login');
    }

    protected function fields()
    {
        return [
            Email::for('email')
                ->label(trans('account.email'))
                ->required()
                ->autofocus(),
            Password::for('password')
                ->label(trans('account.password.label'))
                ->required(),
            Checkbox::for('remember')
                ->label(trans('auth.remember_me'))
        ];
    }

    protected function trans()
    {
        return [
            'forgotPassword' => trans('account.password.forgot'),
            'login' => trans('auth.login')
        ];
    }

    protected function props()
    {
        return [
            'resetPasswordUrl' => Route::has('password.request')
                ? route('password.request')
                : false
        ];
    }
}
