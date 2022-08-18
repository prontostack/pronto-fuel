<?php

namespace App\Fields;

use App\Traits\DataGetterAndSetter;
use JsonSerializable;

abstract class Field implements JsonSerializable
{
    use DataGetterAndSetter;

    abstract protected function component();
    abstract protected function binds();

    public function __construct()
    {
    }

    public static function model(string $model)
    {
        $field = new static();

        $field->set('model', $model);

        return $field;
    }

    public function label(string $label)
    {
        $this->set('label', $label);
        return $this;
    }

    public function storeRules(array $rules)
    {
        $this->set('store_rules', $rules);
        return $this;
    }

    public function updateRules(array $rules)
    {
        $this->set('update_rules', $rules);
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'component' => $this->component(),
            'model' => $this->get('model'),
            'value' => $this->get('value'),
            'binds' => array_replace_recursive(
                $this->binds(),
                [
                    'label' => $this->get('label')
                ]
            )
        ];
    }
}
