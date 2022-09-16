<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\ViewErrorBag;

class ToastService
{
    protected $flashedToasts = [];
    protected $toasts = [];

    public function __call($method, $args)
    {
        array_splice($args, 1, 0, [$method]);

        $this->flashedToasts[] = $this->make(...$args);

        session()->flash('toasts', $this->flashedToasts);

        return $this;
    }

    public function validation($targets)
    {
        session()->flash('validation_toasts', Arr::wrap($targets));

        return $this;
    }

    public function make($message, $type = 'success', $duration = 5000)
    {
        return [
            'type' => $type,
            'text' => $message,
            'duration' => $duration
        ];
    }

    public function getToasts()
    {
        return session()->get('toasts', []);
    }

    public function getFortifyToasts()
    {
        if ($status = session()->get('status', null)) {
            $messages = [
                'two-factor-authentication-enabled' => [trans('account.2fa.unconfirmed'), 'info'],
                'two-factor-authentication-confirmed' => [trans('account.2fa.enabled.label')],
                'two-factor-authentication-disabled' => [trans('account.2fa.disabled.label'), 'info'],
                'verification-link-sent' => [trans('auth.email_verification.link_sent')],
                'profile-information-updated' => [trans('account.profile.updated')],
                'password-updated' => [trans('account.password.updated')],
                'recovery-codes-generated' => [trans('account.2fa.recovery_codes.renewed'), 'info'],
            ];

            if (array_key_exists($status, $messages)) {
                return [$this->make(...$messages[$status])];
            }

            return [$this->make($status)];
        }

        return [];
    }

    public function getValidationToasts()
    {
        $validationErrors = session()->get('errors', app(ViewErrorBag::class));

        $requestedValidationToasts = session()->get('validation_toasts') ?? [];

        $validationToasts = [];

        foreach ($requestedValidationToasts as $key) {
            if ($validationErrors->has($key)) {
                $validationToasts[] = $this->make($validationErrors->first($key), 'error');
            }
        }

        return $validationToasts;
    }

    public function all()
    {
        return array_merge(
            $this->getToasts(),
            $this->getFortifyToasts(),
            $this->getValidationToasts()
        );
    }
}
