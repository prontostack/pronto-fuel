<?php

namespace App\Fields;

class TextField extends Field
{
    protected function component()
    {
        return 'TextField';
    }

    protected function binds()
    {
        return [
            'type' => 'text'
        ];
    }

    public function resolveData()
    {
        return $this->request->input($this->get('model'));
    }
}
