<?php

namespace App\View\Components\DataTable;

use Closure;

class Filter
{
    public $parameter;
    public $label;
    public $clientConverter;
    public $defaultValue;

    public function __construct(string $parameter)
    {
        $this->parameter = $parameter;

        $this->label = trans('general.' . $parameter);
    }

    public static function param(string $parameter)
    {
        return new self($parameter);
    }

    public function defaultsTo($value)
    {
        $this->defaultValue = $value;

        return $this;
    }

    public function labeled(string $label)
    {
        $this->label = $label;
        return $this;
    }

    public function prepareForClient(Closure $closure)
    {
        $this->clientConverter = $closure;
        return $this;
    }

    public static function search()
    {
        $filter = new self('search');

        return $filter->defaultsTo(null);
    }

    public static function createdBetween()
    {
        $filter = new self('created_between');

        return $filter->labeled(trans('general.created_at'))
            ->defaultsTo([])
            ->prepareForClient(function ($value) {
                if (is_string($value)) {
                    return explode(',', $value);
                }
                return $value;
            });
    }

    public static function updatedBetween()
    {
        $filter = new self('updated_between');

        return $filter->labeled(trans('general.last_edit'))
            ->defaultsTo([])
            ->prepareForClient(function ($value) {
                if (is_string($value)) {
                    return explode(',', $value);
                }
                return $value;
            });
    }
}
