<?php

namespace App\View\Components\Dashboard\Account;

use App\View\Component;
use App\View\Components\ConfirmPassword;

class TwoFactorDisabled extends Component
{
    public $enable;
    public $trans;

    public function component()
    {
        return 'AccountTwoFactorDisabled';
    }

    public function __construct()
    {
        $this->enable = (new ConfirmPassword)
            ->method('post')
            ->action(route('two-factor.enable'));

        $this->trans = [
            'configure' => trans('account.2fa.configure'),
            'disabled' =>  [
                'label' => trans('account.2fa.disabled.label'),
                'hint' => trans('account.2fa.disabled.hint')
            ]
        ];
    }
}
