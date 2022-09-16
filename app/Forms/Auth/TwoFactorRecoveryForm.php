<?php

namespace App\Forms\Auth;

use App\Fields\Text;
use App\Forms\Form;

class TwoFactorRecoveryForm extends Form
{
    public function method()
    {
        return 'post';
    }

    public function action()
    {
        return route('two-factor.login');
    }

    protected function fields()
    {
        return [
            Text::for('recovery_code')
                ->label(trans('auth.2fa.recovery_code'))
        ];
    }

    protected function trans()
    {
        return [
            'title' => trans('account.2fa.label'),
            'hint' => trans('account.2fa.recovery_codes.enter'),
            'switchMethod' => trans('auth.2fa.use_authenticator_app')
        ];
    }
}
