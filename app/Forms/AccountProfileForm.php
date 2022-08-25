<?php

namespace App\Forms;

use App\Fields\EmailField;
use App\Fields\TextField;
use Illuminate\Support\Facades\Auth;

class AccountProfileForm extends Form implements FormEditInterface
{
    use FormEditTrait;

    public function editResource()
    {
        return Auth::user();
    }

    public function updateAction()
    {
        return route('account.profile.update');
    }

    public function updatedToast()
    {
        return trans('account.profile.updated');
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
