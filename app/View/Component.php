<?php

namespace App\View;

use Illuminate\Support\Arr;
use Illuminate\View\Component as IlluminateComponent;
use JsonSerializable;

class Component extends IlluminateComponent implements JsonSerializable
{
    public function render()
    {
    }

    public function toArray()
    {
        return [
            'component' => method_exists($this, 'component')
                ? $this->{'component'}()
                : null,
            'binds' => Arr::except($this->extractPublicProperties(), ['attributes', 'componentName'])
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
