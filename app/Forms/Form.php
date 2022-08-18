<?php

namespace App\Forms;

use App\Traits\DataGetterAndSetter;
use Illuminate\Support\Arr;
use JsonSerializable;

abstract class Form implements JsonSerializable
{
    use DataGetterAndSetter;

    protected $request;
    protected $formData;
    protected $action;
    protected $method;
    protected $fields;

    abstract protected function fields();

    public static function edit()
    {
        $form = new static();

        $dataMethod = 'editData';

        if (method_exists($form, $dataMethod)) {
            $data = $form->{$dataMethod}();

            $form->setFormData($data);
        }

        return $form;
    }

    public function __construct()
    {
        $this->request = request();
    }

    public function setFormData($resource)
    {
        $this->formData = Arr::except($resource->toArray(), [
            'updated_at',
            'created_at',
            'email_verified_at'
        ]);
    }

    public function action($action = null)
    {
        if ($action) {
            return $action;
        }

        $actionMethod = 'updateUrl';

        if (data_get($this->formData, 'id') && method_exists($this, $actionMethod)) {
            return $this->{$actionMethod}();
        }

        $actionMethod = 'storeUrl';

        if (method_exists($this, $actionMethod)) {
            return $this->{$actionMethod}();
        }
    }

    public function method($method = null)
    {
        if ($method) {
            return $method;
        }

        if (data_get($this->formData, 'id')) {
            return 'PUT';
        }

        return 'POST';
    }

    private function renderFields()
    {
        return collect($this->fields())->map(function ($field) {
            $value = data_get($this->formData, $field->get('model'));

            $field->set('value', $value);

            return $field;
        });
    }

    public function jsonSerialize()
    {
        return [
            'action' => $this->action(),
            'method' => $this->method(),
            'fields' => $this->renderFields()
        ];
    }
}
