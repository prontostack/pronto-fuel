<?php

namespace App\View\Components;

use App\Forms\Auth\PasswordConfirmationForm;
use App\View\Component;

class ConfirmPassword extends Component
{
    public $action;
    public $method;
    public $confirmPasswordForm;
    public $statusUrl;

    public function component()
    {
        return 'ConfirmPassword';
    }

    public function __construct($options = [])
    {
        $this->confirmPasswordForm = PasswordConfirmationForm::make();
        $this->statusUrl = route('password.confirmation');
    }

    public function action($action)
    {
        $this->action = $action;

        return $this;
    }

    public function method($method)
    {
        $this->method = $method;

        return $this;
    }
}
