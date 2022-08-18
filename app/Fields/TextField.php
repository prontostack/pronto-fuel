<?php

namespace App\Fields;

class TextField extends Field
{
    protected function component()
    {
        return 'q-input';
    }

    protected function binds()
    {
        return [
            'type' => 'text',
            'outlined' => true
        ];
    }
}
