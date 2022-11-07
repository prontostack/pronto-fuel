<?php

namespace App\Fields;

use App\Fields\Field;

class Checkbox extends Field
{
    public function component()
    {
        return 'Checkbox';
    }

    public function store($resourceData)
    {
        return $this->request->boolean($this->get('model'));
    }
}
