<?php

namespace App\View\Components\Dashboard\Account;

use App\Forms\Dashboard\Account\TwoFactorConfirmationForm;
use App\View\Component;

class TwoFactorUnconfirmed extends Component
{
    public $qrCode;
    public $confirm;
    public $trans;

    public function component()
    {
        return 'AccountTwoFactorUnconfirmed';
    }

    public function __construct()
    {
        $this->qrCode = auth()->user()->twoFactorQrCodeSvg();

        $this->confirm = TwoFactorConfirmationForm::make()
            ->hideSubmit()
            ->confirmPassword();

        $this->trans = [
            'readQrCode' => [
                'label' => trans('account.2fa.read_qr_code.label'),
                'hint' => trans('account.2fa.read_qr_code.hint'),
            ],
            'enable' =>  trans('account.2fa.enable'),
        ];
    }
}
