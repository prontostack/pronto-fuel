<?php

namespace App\Forms\Auth;

use App\Forms\Form;

class EmailVerificationForm extends Form
{
    protected function method()
    {
        return 'post';
    }

    protected function action()
    {
        return route('verification.send');
    }

    protected function props()
    {
        return [
            'logoutUrl' => route('logout')
        ];
    }

    protected function trans()
    {
        return [
            'hint' => trans('auth.email_verification.hint'),
            'logout' => trans('auth.logout'),
            'submit' => trans('auth.email_verification.resend_link'),
            'title' => trans('auth.email_verification.label'),
        ];
    }
}
