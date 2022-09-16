<?php

namespace App\Forms\Dashboard\Account;

use App\Fields\OTP;
use App\Forms\Form;

class TwoFactorConfirmationForm extends Form
{
    public function method()
    {
        return 'post';
    }

    public function action()
    {
        return route('two-factor.confirm');
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
            'title' => trans('account.2fa.enable'),
            'hint' => trans('account.2fa.verification_code.hint')
        ];
    }
}
