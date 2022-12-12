<?php

namespace App\Http\Controllers\Dashboard\Account;

use App\Forms\Dashboard\Account\PasswordUpdateForm;
use App\Http\Controllers\Controller;
use App\View\Components\Dashboard\Account\TwoFactorStatus;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function edit(Request $request)
    {
        $title = trans('account.security.label');

        $passwordUpdateForm = PasswordUpdateForm::make()->resetOnSuccess();

        $twoFactorStatus = new TwoFactorStatus;

        return inertia()->render('Dashboard/Account/Security', compact([
            'title',
            'passwordUpdateForm',
            'twoFactorStatus'
        ]));
    }
}
