<?php

namespace App\Forms;

use App\Traits\DataGetterAndSetter;
use App\View\Components\ConfirmPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use JsonSerializable;

class Form implements JsonSerializable
{
    use DataGetterAndSetter;

    protected $request;
    protected $mode;
    protected $resource;
    protected $resourceData;
    protected $method;
    protected $action;
    protected $fields;
    protected $rules;
    protected $redirect;
    protected $result;
    protected $resetOnSuccess = false;
    protected $hideSubmit = false;

    public function __construct($mode = null)
    {
        $this->request = request();

        $this->mode = $mode;

        $this->setResource()
            ->setMethod()
            ->setAction()
            ->setFields();

        if ($this->submitting()) {
            $this->setRules();
        }
    }

    public static function make()
    {
        return new static;
    }

    public static function create()
    {
        return new static('create');
    }

    public static function edit()
    {
        return new static('edit');
    }

    protected function creating()
    {
        return $this->mode === 'create';
    }

    protected function editing()
    {
        return $this->mode === 'edit';
    }

    protected function submitting()
    {
        return ($this->method === strtolower($this->request->method()));
    }

    public function setResource()
    {
        if (method_exists($this, 'resource')) {
            $this->resource = $this->{'resource'}();
        } else if ($this->creating() && method_exists($this, 'createResource')) {
            $this->resource = $this->{'createResource'}();
        } else if ($this->editing() && method_exists($this, 'editResource')) {
            $this->resource = $this->{'editResource'}();
        }

        return $this->setFormData();
    }

    public function setFormData()
    {
        if ($this->resource instanceof Model) {
            $this->resourceData = $this->resource->toArray();
        } else if (is_array($this->resource)) {
            $this->resourceData = $this->resource;
        }

        return $this;
    }

    public function setMethod()
    {
        if (method_exists($this, 'method')) {
            $this->method = strtolower($this->{'method'}());
        } else if ($this->creating()) {
            $this->method = method_exists($this, 'createMethod')
                ? strtolower($this->{'createMethod'}())
                : 'post';
        } else if ($this->editing()) {
            $this->method = method_exists($this, 'editMethod')
                ? strtolower($this->{'editMethod'}())
                : 'put';
        }

        return $this;
    }

    public function setAction()
    {
        if (method_exists($this, 'action')) {
            $this->action = $this->{'action'}();
        } else if ($this->creating() && method_exists($this, 'createAction')) {
            $this->action = $this->{'createAction'}();
        } else if ($this->editing() && method_exists($this, 'editAction')) {
            $this->action = $this->{'editAction'}();
        }

        return $this;
    }

    public function setFields()
    {
        if (method_exists($this, 'fields')) {
            $this->fields = collect($this->{'fields'}());
        } else if ($this->creating() && method_exists($this, 'createFields')) {
            $this->fields = collect($this->{'createFields'}());
        } else if ($this->editing() && method_exists($this, 'editAction')) {
            $this->fields = collect($this->{'editAction'}());
        }

        return $this;
    }

    private function setRules($methodRulesKey = null)
    {
        $this->rules = $this->fields->flatMap(function ($field) use ($methodRulesKey) {
            $column = $field->get('model');
            $rules = $field->get('rules', []);

            if ($this->creating()) {
                $rules = array_merge($rules, $field->get('createRules', []));
            }

            if ($this->editing()) {
                $rules = array_merge($rules, $field->get('editRules', []));
            }

            return [
                $column => $rules
            ];
        })->all();

        return $this;
    }

    private function renderFields()
    {
        if (empty($this->fields)) {
            return null;
        }

        return $this->fields->map(function ($field) {
            if (!$value = $field->get('value', null)) {
                $field->render($this->resourceData);
            }

            return $field;
        });
    }

    public function save()
    {
        return $this->validate()
            ->resolveFields()
            ->handleSave()
            ->handleOnSuccess()
            ->handleRedirect();
    }

    public function process()
    {
        return $this->save();
    }

    public function validate()
    {
        $this->request->validate($this->rules);

        return $this;
    }

    protected function resolveFields()
    {
        $resourceData = $this->resourceData;

        $this->result = $this->fields->reduce(function ($result, $field) use ($resourceData) {
            data_set($result, $field->get('model'), $field->resolve($resourceData));

            return $result;
        }, []);

        return $this;

        // $this->result = [];

        // foreach ($this->fields->all() as $key => $field) {
        //     $column = $field->get('model');

        //     $currentValue = data_get($this->resourceData, $column);

        //     $newValue = $field->resolve($currentValue);

        //     data_set($this->result, $column, $newValue);
        // }

        // return $this;
    }

    public function handleSave()
    {
        if (method_exists($this, 'beforeSave') && $result = $this->{'beforeSave'}($this->result)) {
            $this->result = $result;
        }

        if ($this->resource instanceof Model) {
            $this->resource->fill($this->result);

            $this->resource->save();
        }

        return $this;
    }

    private function handleOnSuccess()
    {
        if (method_exists($this, 'onSuccess')) {
            $this->{'onSuccess'}();
        }

        return $this;
    }

    private function handleRedirect()
    {
        $this->redirect = back();

        if (method_exists($this, 'redirect')) {
            $this->redirect = $this->{'redirect'}();
        } else if ($this->creating() && method_exists($this, 'createRedirect')) {
            $this->redirect = $this->{'createRedirect'}();
        } else if ($this->editing() && method_exists($this, 'editRedirect')) {
            $this->redirect = $this->{'editRedirect'}();
        }

        return $this->handleToast();
    }

    private function handleToast()
    {
        $toast = null;

        if (method_exists($this, 'toast')) {
            $toast = $this->{'toast'}();
        } else if ($this->creating() && method_exists($this, 'createToast')) {
            $toast = $this->{'createToast'}();
        } else if ($this->editing() && method_exists($this, 'editToast')) {
            $toast = $this->{'editToast'}();
        }

        $toast = Arr::wrap($toast);

        if ($toast) {
            return $this->redirect->toast(...$toast);
        }

        return $this->redirect;
    }

    public function resetOnSuccess($reset = true)
    {
        $this->resetOnSuccess = $reset;

        return $this;
    }

    public function hideSubmit()
    {
        $this->hideSubmit = true;

        return $this;
    }

    public function confirmPassword()
    {
        $this->set('confirmPassword', new ConfirmPassword);

        return $this;
    }

    protected function getTranslations()
    {
        $trans = (method_exists($this, 'trans'))
            ? $this->{'trans'}()
            : [];

        return array_replace_recursive([
            'submit' => trans('form.submit')
        ], $trans);
    }

    public function toArray()
    {
        $data = [
            'action' => $this->action,
            'method' => $this->method,
            'fields' => $this->renderFields(),
            'resetOnSuccess' => $this->resetOnSuccess,
            'hideSubmit' => $this->hideSubmit,
            'confirmPassword' => $this->get('confirmPassword'),
            'trans' => $this->getTranslations()
        ];

        if (method_exists($this, 'props')) {
            $data = array_replace_recursive($data, $this->{'props'}());
        }

        return $data;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
