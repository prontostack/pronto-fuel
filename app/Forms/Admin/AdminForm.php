<?php

namespace App\Forms\Admin;

use App\Fields\Email;
use App\Fields\Password;
use App\Fields\Text;
use App\Forms\Form;
use App\Models\Admin;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password as PasswordRules;

class AdminForm extends Form
{
    protected function createResource()
    {
        return new Admin;
    }

    protected function editResource()
    {
        return $this->request->admin;
    }

    protected function createAction()
    {
        return route('admin.admins.store');
    }

    protected function editAction()
    {
        return route('admin.admins.update', $this->resource->id);
    }

    protected function fields()
    {
        return [
            Text::for('name')
                ->label(trans('account.name'))
                ->rules(['required', 'string', 'max:255']),
            // ->required(),

            Email::for('email')
                ->label(trans('account.email'))
                ->rules([
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(Admin::class)->ignore($this->resource->id)
                ]),
            // ->required(),

            Password::for('password')
                ->label(trans('account.password.label'))
                ->rules([
                    'sometimes',
                    'required',
                    'string',
                    new PasswordRules,
                    'confirmed'
                ]),
            // ->required(),

            Password::for('password_confirmation')
                ->label(trans('account.password.confirm'))
                ->rules([
                    'sometimes',
                    'required',
                    'string',
                    new PasswordRules,
                    'same:password'
                ])
            // ->required()
        ];
    }

    protected function trans()
    {
        return [
            // ...
        ];
    }

    protected function props()
    {
        return [
            // ...
        ];
    }

    protected function toast()
    {
        return 'Admin updated';
    }
}
