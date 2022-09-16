<?php

namespace App\Http\Controllers\Dashboard\Account;

use App\Forms\Dashboard\Account\PasswordUpdateForm;
use App\Forms\Dashboard\Account\ProfileForm;
use App\Http\Controllers\Controller;
use App\Services\TwoFactorAuth;
use App\View\Components\Dashboard\Account\TwoFactorStatus;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request, TwoFactorAuth $twoFactorAuth)
    {
        $title = trans('account.my_account');

        $profileForm = ProfileForm::make();

        $passwordUpdateForm = PasswordUpdateForm::make()->resetOnSuccess();

        $twoFactorStatus = new TwoFactorStatus;

        return inertia()->render('Dashboard/Account', compact([
            'title',
            'profileForm',
            'passwordUpdateForm',
            'twoFactorStatus'
        ]));
    }
}
