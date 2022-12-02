<?php

namespace App\Fields;

use App\Fields\Field;
use Illuminate\Validation\ValidationException;

class RichText extends Field
{
    public function component()
    {
        return 'RichText';
    }

    // public function binds()
    // {
    //    return [];
    // }

    public function render($resourceData)
    {
        $value = data_get($resourceData, $this->get('model'));

        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        $this->set('value', $value);

        return $this;
    }

    public function store($resourceData)
    {
        $input = $this->request->input($this->get('model'));

        if (is_string($input)) {
            $input = json_decode($input, true);
        }

        return json_encode($input);
    }
}
