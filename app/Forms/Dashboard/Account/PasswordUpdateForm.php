<?php

namespace App\Forms\Dashboard\Account;

use App\Actions\Fortify\PasswordValidationRules;
use App\Fields\Password;
use App\Forms\Form;

class PasswordUpdateForm extends Form
{
    use PasswordValidationRules;

    protected function resource()
    {
        return auth()->user();
    }

    protected function method()
    {
        return 'put';
    }

    protected function action()
    {
        return route('account.password');
    }

    protected function fields()
    {
        return [
            Password::for('current_password')
                ->label(trans('account.password.current'))
                ->rules(['required', 'string', 'current_password']),

            Password::for('password')
                ->label(trans('account.password.new'))
                ->rules($this->passwordRules()),

            Password::for('password_confirmation')
                ->label(trans('account.password.confirm'))
                ->rules(['required', 'string', 'same:password'])
        ];
    }

    protected function trans()
    {
        return [
            'label' => trans('account.password.update'),
            'hint' => trans('account.password.hint'),
            'submit' => trans('form.update')
        ];
    }

    protected function toast()
    {
        return trans('account.password.updated');
    }
}
