<?php

namespace App\View\Components\Dashboard\Account;

use App\View\Component;
use App\View\Components\ConfirmPassword;

class TwoFactorEnabled extends Component
{
    public $disable;
    public $recoveryCodes;
    public $regenerateRecoveryCodes;
    public $showRecoveryCodes;
    public $trans;

    public function component()
    {
        return 'AccountTwoFactorEnabled';
    }

    public function __construct()
    {
        $user = auth()->user();

        if ($user->hasConfirmedPassword()) {
            $this->recoveryCodes = $user->recoveryCodes();

            $this->regenerateRecoveryCodes = (new ConfirmPassword)
                ->method('post')
                ->action(route('two-factor.recovery-codes'));
        } else {
            $this->showRecoveryCodes = new ConfirmPassword;
        }

        $this->disable = (new ConfirmPassword)
            ->method('delete')
            ->action(route('two-factor.disable'));

        $this->trans = [
            'disable' =>  trans('account.2fa.disable'),
            'enabled' =>  [
                'label' => trans('account.2fa.enabled.label'),
                'hint' => trans('account.2fa.enabled.hint')
            ],
            'recoveryCodes' => [
                'label' => trans('account.2fa.recovery_codes.label'),
                'hint' => trans('account.2fa.recovery_codes.hint'),
                'show' => trans('account.2fa.recovery_codes.show'),
                'regenerate' => trans('account.2fa.recovery_codes.regenerate'),
            ]
        ];
    }
}
