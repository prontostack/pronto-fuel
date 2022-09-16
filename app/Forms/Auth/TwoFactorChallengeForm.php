<?php

namespace App\Forms\Auth;

use App\Fields\OTP;
use App\Forms\Form;

class TwoFactorChallengeForm extends Form
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
            OTP::for('code')
                ->label(trans('account.2fa.verification_code.label'))
                ->justify('center')
                ->submitOnComplete()
        ];
    }

    protected function trans()
    {
        return [
            'title' => trans('account.2fa.label'),
            'hint' => trans('account.2fa.verification_code.hint'),
            'switchMethod' => trans('auth.2fa.use_recovery_code')
        ];
    }
}
