<?php

namespace App\View\Components\Dashboard\Account;

use App\View\Component;

class TwoFactorStatus extends Component
{
    public $status;
    public $trans;

    public function component()
    {
        return 'AccountTwoFactorStatus';
    }

    public function __construct()
    {
        $user = auth()->user();

        if ($user->hasEnabledTwoFactorAuthentication()) {
            $this->status = new TwoFactorEnabled;
        } else if ($user->mustConfirmTwoFactorAuthentication()) {
            $this->status = new TwoFactorUnconfirmed;
        } else {
            $this->status = new TwoFactorDisabled;
        }

        $this->trans = [
            'label' => trans('account.2fa.label'),
            'hint' => trans('account.2fa.hint')
        ];
    }
}
