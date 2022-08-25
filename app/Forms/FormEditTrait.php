<?php

namespace App\Forms;

trait FormEditTrait
{
    public static function edit()
    {
        $form = new static();

        $resource = $form->editResource();

        $form->setResource($resource);

        $form->setFormData($form->resource);

        $form->method('put');

        $action = $form->updateAction();

        $form->action($action);

        return $form;
    }

    public static function update()
    {
        $form = new static();

        $resource = $form->editResource();

        $form->setResource($resource);

        $form->method('put');

        $form->setUpdateRules();

        return $form;
    }
}
