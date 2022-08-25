<?php

namespace App\Http\Controllers\Dashboard;

use App\Forms\AccountProfileForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountProfileController extends Controller
{
    public function update(Request $request)
    {
        $form = AccountProfileForm::update();

        return $form->save();
    }
}
