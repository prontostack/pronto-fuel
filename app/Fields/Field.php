<?php

namespace App\Fields;

use App\Traits\DataGetterAndSetter;
use Closure;
use JsonSerializable;

abstract class Field implements JsonSerializable
{
    use DataGetterAndSetter;

    protected $request;
    protected $resolveOverride;

    abstract protected function component();

    public function __construct($model)
    {
        $this->request = request();

        $this->set('model', $model);

        $this->set('component', $this->component());

        $this->setBinds();
    }

    private function setBinds()
    {
        if (method_exists($this, 'binds')) {
            $this->set('binds', $this->{'binds'}());
        }
    }

    public static function for(string $model)
    {
        $field = new static($model);

        return $field;
    }

    public function label(string $label)
    {
        $this->set('binds.label', $label);

        return $this;
    }

    public function required()
    {
        $this->set('binds.required', true);

        return $this;
    }

    public function value($value = null)
    {
        $this->set('value', $value);

        return $this;
    }

    public function rules($rules = [])
    {
        $existingRules = $this->get('rules', []);

        $this->set('rules', $existingRules + $rules);

        return $this;
    }

    public function createRules($rules = [])
    {
        $existingRules = $this->get('rules', []);

        $this->set('createRules', $existingRules + $rules);

        return $this;
    }

    public function editRules($rules = [])
    {
        $existingRules = $this->get('rules', []);

        $this->set('editRules', $existingRules + $rules);

        return $this;
    }

    public function store($resourceData)
    {
        return $this->request->input($this->get('model'));
    }

    public function resolveWith($override)
    {
        $this->resolveOverride = $override;

        return $this;
    }

    public function resolve($resourceData)
    {
        if ($this->resolveOverride instanceof Closure) {
            return ($this->resolveOverride)($resourceData);
        } else if ($this->resolveOverride) {
            return $this->resolveOverride;
        }

        return $this->store($resourceData);
    }

    public function render($resourceData)
    {
        $value = data_get($resourceData, $this->get('model'));

        $this->set('value', $value);

        return $this;
    }

    public function jsonSerialize()
    {
        return $this->data;
    }
}
