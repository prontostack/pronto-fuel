<?php

namespace App\Fields;

class EmailField extends TextField
{
    protected function binds()
    {
        return [
            'type' => 'email',
            'outlined' => true
        ];
    }
}
