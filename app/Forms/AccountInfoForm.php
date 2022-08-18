<?php

namespace App\Forms;

use App\Fields\EmailField;
use App\Fields\TextField;
use Illuminate\Support\Facades\Auth;

class AccountInfoForm extends Form
{
    protected function editData()
    {
        return Auth::user();
    }

    protected function updateUrl()
    {
        return route('account.info.update');
    }

    protected function fields()
    {
        return [
            TextField::model('name')
                ->label(trans('account.name'))
                ->updateRules(['required', 'string']),

            EmailField::model('email')
                ->label(trans('account.email'))
                ->updateRules(['required', 'email'])
        ];
    }
}
