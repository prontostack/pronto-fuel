<?php

namespace App\View;

use Illuminate\Support\Arr;
use Illuminate\View\Component as IlluminateComponent;
use JsonSerializable;

class Component extends IlluminateComponent implements JsonSerializable
{
    protected $binds = [];

    public function render()
    {
    }

    public function __call($method, $arg)
    {
        data_set($this->binds, $method, ...$arg);
        return $this;
    }

    public function toArray()
    {
        return [
            'component' => method_exists($this, 'component')
                ? $this->{'component'}()
                : null,
            'binds' => array_replace_recursive(
                Arr::except($this->extractPublicProperties(), ['attributes', 'componentName']),
                $this->binds
            )
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
