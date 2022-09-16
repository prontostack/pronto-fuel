<?php

namespace App\Http\Controllers\Dashboard\Account;

use App\Forms\Dashboard\Account\ProfileForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $form = ProfileForm::make();

        return $form->save();
    }
}
