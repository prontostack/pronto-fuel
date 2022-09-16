<?php

namespace App\Fields;

use App\Fields\Field;

class Checkbox extends Field
{
    public function component()
    {
        return 'Checkbox';
    }

    public function resolveData()
    {
        return $this->request->boolean($this->get('model'));
    }
}
