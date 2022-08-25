<?php

namespace App\Forms;

use App\Fields\PasswordField;
use App\Fields\TextField;
use Illuminate\Support\Facades\Auth;

class AccountPasswordForm extends Form implements FormEditInterface
{
    use FormEditTrait;

    public function editResource()
    {
        return Auth::user();
    }

    public function updateAction()
    {
        return route('account.password.update');
    }

    public function updatedToast()
    {
        return trans('account.password.updated');
    }

    protected function fields()
    {
        return [
            PasswordField::model('current_password')
                ->label(trans('account.password.current'))
                ->updateRules(['required', 'current_password']),

            PasswordField::model('password')
                ->label(trans('account.password.new'))
                ->updateRules(['required', 'confirmed']),

            PasswordField::model('password_confirmation')
                ->label(trans('account.password.confirm'))
                ->updateRules(['required', 'same:password'])
        ];
    }
}
