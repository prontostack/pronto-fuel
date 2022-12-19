<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreferencesController extends Controller
{
    public function edit(Request $request)
    {
        $title = trans('account.preferences.label');

        $trans = [
            'dark_mode' => [
                'title' => trans('account.preferences.dark_mode.title'),
                'hint' => trans('account.preferences.dark_mode.hint'),
                'label' => trans('account.preferences.dark_mode.label')
            ]
        ];

        return inertia()->renderEndpoint('Account/Preferences', compact([
            'title',
            'trans'
        ]));
    }
}
