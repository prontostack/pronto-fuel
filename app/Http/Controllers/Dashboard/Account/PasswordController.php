<?php

namespace App\Http\Controllers\Dashboard\Account;

use App\Forms\Dashboard\Account\PasswordUpdateForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
        $form = PasswordUpdateForm::make();

        return $form->save();
    }
}
