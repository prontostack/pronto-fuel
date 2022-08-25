<?php

namespace App\Fields;

use Illuminate\Support\Facades\Hash;

class PasswordField extends TextField
{
    protected function binds()
    {
        return [
            'type' => 'password'
        ];
    }

    public function resolveData()
    {
        $password = $this->request->input($this->get('model'));

        return Hash::make($password);
    }
}
