<?php

namespace App\Forms;

use App\Traits\DataGetterAndSetter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use JsonSerializable;

abstract class Form implements JsonSerializable
{
    use DataGetterAndSetter;

    protected $request;
    protected $resource;
    protected $formData;
    protected $action;
    protected $method;
    protected $fields;
    protected $rules;
    protected $resetOnSuccess = false;

    abstract protected function fields();

    public function __construct()
    {
        $this->request = request();
        $this->fields = collect($this->fields());
    }

    public function setResource(Model $resource)
    {
        $this->resource = $resource;

        return $this;
    }

    public function setFormData($resource)
    {
        $this->formData = Arr::except($resource->toArray(), [
            'updated_at',
            'created_at',
            'email_verified_at'
        ]);
    }

    public function method($method = 'post')
    {
        $this->method = $method;
    }

    public function action($action = null)
    {
        $this->action = $action;
    }

    public function resetOnSuccess($reset = true)
    {
        $this->resetOnSuccess = $reset;

        return $this;
    }

    protected function setUpdateRules()
    {
        return $this->setRules('update_rules');
    }

    private function setRules($methodRules)
    {
        $this->rules = $this->fields->flatMap(function ($field) use ($methodRules) {
            return [
                $field->get('model') => $field->get($methodRules)
            ];
        })->all();

        return $this;
    }

    private function renderFields()
    {
        return $this->fields->map(function ($field) {
            $value = data_get($this->formData, $field->get('model'));

            $field->set('value', $value);

            return $field;
        });
    }

    public function updateData()
    {
        return $this->request->all();
    }

    public function save()
    {
        $this->validate();

        $data = $this->resolveFieldsData();

        $this->resource->fill($data);

        $this->resource->save();

        $toast = $this->getToast();

        if ($toast) {
            return back()->toast($toast);
        }

        return back();
    }

    public function validate()
    {
        $this->request->validate($this->rules);
    }

    protected function resolveFieldsData()
    {
        $resource = $this->resource;

        return $this->fields->flatMap(function ($field) use ($resource) {
            if (!array_key_exists($field->get('model'), $resource->attributesToArray())) {
                return;
            }

            return [
                $field->get('model') => $field->resolveData()
            ];
        })->all();
    }

    protected function getToast()
    {
        if ($this->method === 'put' && method_exists($this, 'updatedToast')) {
            return $this->{'updatedToast'}();
        }

        if (method_exists($this, 'createdToast')) {
            return $this->{'createdToast'}();
        }

        return false;
    }

    public function jsonSerialize()
    {
        return [
            'action' => $this->action,
            'method' => $this->method,
            'fields' => $this->renderFields(),
            'resetOnSuccess' => $this->resetOnSuccess
        ];
    }
}
