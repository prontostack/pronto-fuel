<?php

namespace App\Forms\Auth;

use App\Fields\Email;
use App\Fields\Password;
use App\Fields\Text;
use App\Forms\Form;

class RegistrationForm extends Form
{
    protected function method()
    {
        return 'post';
    }

    protected function action()
    {
        return route('register');
    }

    protected function fields()
    {
        return [
            Text::for('name')
                ->label(trans('account.name'))
                ->required()
                ->autofocus(),

            Email::for('email')
                ->label(trans('account.email'))
                ->required(),

            Password::for('password')
                ->label(trans('account.password.label'))
                ->required(),

            Password::for('password_confirmation')
                ->label(trans('account.password.confirm'))
                ->required()
        ];
    }

    protected function trans()
    {
        return [
            'alreadyRegistered' => trans('auth.already_registered'),
            'submit' => trans('auth.register')
        ];
    }

    protected function props()
    {
        return [
            'loginUrl' => route('login')
        ];
    }
}
