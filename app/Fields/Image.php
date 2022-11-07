<?php

namespace App\Fields;

use App\Fields\Field;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Image extends Field
{
    protected $disk = 'public';
    protected $directory = null;
    protected $defaultPreview = null;

    public function component()
    {
        return 'Image';
    }

    public function width($width)
    {
        $this->set('binds.width', $width);

        return $this;
    }

    public function height($height)
    {
        $this->set('binds.height', $height);

        return $this;
    }

    public function crop($ratio = 1)
    {
        $this->set('binds.cropperSettings.stencilProps.aspectRatio', $ratio);

        return $this;
    }

    public function disk($disk)
    {
        $this->disk = $disk;

        return $this;
    }

    public function storeAt($directory)
    {
        $this->directory = $directory;

        return $this;
    }

    public function preview($defaultPreview)
    {
        $this->defaultPreview = $defaultPreview;

        return $this;
    }

    // public function binds()
    // {
    //     return [];
    // }

    public function render($formData)
    {
        $value = data_get($formData, $this->get('model'));

        if (!empty($value) && !Str::startsWith($value, 'http')) {
            $value = Storage::url($value);
        }

        if (empty($value) && $this->defaultPreview) {
            $value = $this->defaultPreview;
        }

        $this->set('binds.preview', $value);

        return $this;
    }

    public function store($resourceData)
    {
        $column = $this->get('model');
        $currentValue = data_get($resourceData, $column);

        if ($this->request->input($column) === 'remove') {
            if (!empty($currentValue) && Storage::disk('public')->exists($currentValue)) {
                Storage::disk('public')->delete($currentValue);
            }

            return null;
        }

        if (!$this->request->hasFile($column)) {
            return $currentValue;
        }

        return $this->request->file($column)
            ->store($this->directory, $this->disk);
    }
}
