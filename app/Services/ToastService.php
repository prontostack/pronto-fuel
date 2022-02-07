<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ViewErrorBag;

class ToastService
{
    protected $flashedToasts = [];
    protected $toasts = [];

    public function __call($method, $args)
    {
        array_splice($args, 1, 0, [$method]);

        $this->flashedToasts[] = $this->make(...$args);

        Session::flash('toasts', $this->flashedToasts);

        return $this;
    }

    public function validation($targets)
    {
        Session::flash('validation_toasts', Arr::wrap($targets));

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
        return Session::get('toasts') ?? [];
    }

    public function getValidationToasts()
    {
        $validationErrors = Session::get('errors', app(ViewErrorBag::class));

        $requestedValidationToasts = Session::get('validation_toasts') ?? [];

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
            $this->getValidationToasts()
        );
    }
}
