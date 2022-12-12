<?php

namespace App\Http\Controllers\Dashboard\Account;

use App\Forms\Dashboard\Account\ProfileForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $title = trans('account.profile.label');

        $profileForm = ProfileForm::make();

        return inertia()->render('Dashboard/Account/Profile', compact([
            'title',
            'profileForm'
        ]));
    }

    public function update(Request $request)
    {
        $form = ProfileForm::make();

        return $form->save();
    }
}
