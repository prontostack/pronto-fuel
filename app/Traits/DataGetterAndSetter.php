<?php

namespace App\Traits;

trait DataGetterAndSetter
{
    protected $data = [];

    public function set($key, $value = null)
    {
        data_set($this->data, $key, $value);

        return $this;
    }

    public function get($key, $default = null)
    {
        return data_get($this->data, $key, $default);
    }
}
