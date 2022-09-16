<?php

namespace App\Forms\Auth;

use App\Fields\Email;
use App\Forms\Form;

class ForgotPasswordForm extends Form
{
    protected function method()
    {
        return 'post';
    }

    protected function action()
    {
        return route('password.email');
    }

    protected function fields()
    {
        return [
            Email::for('email')
                ->label(trans('account.email'))
                ->required()
                ->autofocus()
        ];
    }

    protected function trans()
    {
        return [
            'title' => trans('account.password.forgot'),
            'hint' => trans('auth.forgot_password'),
            'submit' => trans('auth.email_password_reset_link')
        ];
    }
}
