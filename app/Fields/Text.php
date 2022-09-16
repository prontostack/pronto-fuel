<?php

namespace App\Fields;

class Text extends Field
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

    public function autofocus()
    {
        $this->set('binds.autofocus', true);

        return $this;
    }
}
