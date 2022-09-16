<?php

namespace App\Forms\Auth;

use App\Fields\Hidden;
use App\Fields\Password;
use App\Forms\Form;

class PasswordResetForm extends Form
{
    protected function method()
    {
        return 'post';
    }

    protected function action()
    {
        return route('password.update');
    }

    protected function fields()
    {
        return [
            Hidden::for('email')
                ->value($this->request->input('email')),

            Hidden::for('token')
                ->value($this->request->route('token')),

            Password::for('password')
                ->label(trans('account.password.label'))
                ->required()
                ->autofocus(),

            Password::for('password_confirmation')
                ->label(trans('account.password.confirm'))
        ];
    }

    protected function trans()
    {
        return [
            'title' => trans('auth.reset_password'),
            'submit' => trans('auth.reset_password')
        ];
    }
}
