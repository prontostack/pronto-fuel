<?php

namespace App\Http\Controllers\Dashboard;

use App\Forms\AccountPasswordForm;
use App\Forms\AccountProfileForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function edit(Request $request)
    {
        $title = trans('account.my_account');

        $profileForm = AccountProfileForm::edit();
        $passwordForm = AccountPasswordForm::edit()->resetOnSuccess();

        return inertia()->render('Dashboard/Account', compact([
            'title',
            'profileForm',
            'passwordForm'
        ]));
    }
}
