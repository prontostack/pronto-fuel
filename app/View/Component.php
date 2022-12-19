<?php

namespace App\View;

use Illuminate\Support\Arr;
use Illuminate\View\Component as IlluminateComponent;
use JsonSerializable;
use Illuminate\Support\Str;

class Component extends IlluminateComponent implements JsonSerializable
{
    public $binds = [];

    public function render()
    {
    }

    public function __call($method, $arg)
    {
        data_set($this->binds, Str::snake($method), ...$arg);

        return $this;
    }

    public function toArray()
    {
        $binds = array_replace_recursive(
            Arr::except($this->extractPublicProperties(), ['attributes', 'componentName']),
            $this->binds
        );

        if (method_exists($this, 'component')) {
            return [
                'component' => $this->{'component'}(),
                'binds' => $binds
            ];
        }

        return $binds;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
