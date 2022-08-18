<?php

namespace App\Http\Controllers\Dashboard;

use App\Forms\AccountInfoForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountInfoController extends Controller
{
    public function edit(Request $request)
    {
        $title = trans('account.my_account');

        $form = AccountInfoForm::edit();

        return inertia()->render('Dashboard/Account', compact([
            'title',
            'form'
        ]));
    }
}
