<?php

namespace App\Fields;

use Illuminate\Support\Facades\Hash;

class Password extends Text
{
    protected function binds()
    {
        return [
            'type' => 'password'
        ];
    }

    public function store($resourceData)
    {
        $password = $this->request->input($this->get('model'));

        return Hash::make($password);
    }
}
