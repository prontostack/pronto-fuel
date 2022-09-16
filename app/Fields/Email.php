<?php

namespace App\Fields;

class Email extends Text
{
    protected function binds()
    {
        return [
            'type' => 'email'
        ];
    }
}
