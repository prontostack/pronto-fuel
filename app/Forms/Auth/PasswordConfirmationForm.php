<?php

namespace App\Forms\Auth;

use App\Fields\Password;
use App\Forms\Form;

class PasswordConfirmationForm extends Form
{
    public function method()
    {
        return 'post';
    }

    public function action()
    {
        return route('password.confirm');
    }

    protected function fields()
    {
        return [
            Password::for('password')
                ->label(trans('account.password.confirm'))
                ->autofocus()
                ->rules(['required', 'current_password'])
        ];
    }

    protected function trans()
    {
        return [
            'title' => trans('account.password.confirm'),
            'hint' => trans('account.password.confirm_hint')
        ];
    }
}
