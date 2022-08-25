<?php

namespace App\Http\Controllers\Dashboard;

use App\Forms\AccountPasswordForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountPasswordController extends Controller
{
    public function update(Request $request)
    {
        $form = AccountPasswordForm::update();

        $form->save();
    }
}
