<?php

namespace App\Forms\Dashboard\Account;

use App\Fields\Email;
use App\Fields\Image;
use App\Fields\Text;
use App\Forms\Form;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Validation\Rule;

class ProfileForm extends Form
{
    private $mustInvalidateEmail = false;

    protected function resource()
    {
        return auth()->user();
    }

    protected function method()
    {
        return 'put';
    }

    protected function action()
    {
        return route('account.profile');
    }

    protected function fields()
    {
        return [
            Text::for('name')
                ->label(trans('account.name'))
                ->rules(['required', 'string', 'max:255']),

            Email::for('email')
                ->label(trans('account.email'))
                ->rules(['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->resource->id)]),

            Image::for('avatar')
                ->label(trans('account.avatar'))
                ->width('80px')
                ->height('80px')
                ->crop()
                ->storeAt('avatars'),
        ];
    }

    protected function trans()
    {
        return [
            'label' => trans('account.profile.label'),
            'hint' => trans('account.profile.hint'),
            'submit' => trans('form.update')
        ];
    }

    protected function beforeSave($data)
    {
        if (
            $this->resource instanceof MustVerifyEmail &&
            $data['email'] !== $this->resource->email
        ) {
            $this->mustInvalidateEmail = true;
        }
    }

    protected function onSuccess()
    {
        if ($this->mustInvalidateEmail) {
            $this->resource->invalidateEmailVerification();
            $this->resource->sendEmailVerificationNotification();
        }
    }

    protected function toast()
    {
        return trans('account.profile.updated');
    }
}
