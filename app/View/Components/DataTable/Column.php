<?php

namespace App\View\Components\DataTable;

use Illuminate\Support\Arr;

class Column
{
    public $property;
    public $header;
    public $searches = [];
    public $sorts = [];

    public function __construct($property)
    {
        $this->property = $property;

        $this->setHeader();
    }

    public static function for($property)
    {
        return new self($property);
    }

    public function setHeader($value = null)
    {
        if (is_array($value) && Arr::isAssoc($value)) {
            $this->header = $value;
            return $this;
        }

        $this->header = [
            'align' => 'left',
            'sortable' => false,
            'value' => $this->property,
            'text' => trans('datatable.' . $this->property)
        ];

        return $this;
    }

    public function labeled($value)
    {
        $this->header['text'] = $value;
        return $this;
    }

    public function searchable($databaseColumns = null)
    {
        if (is_string($databaseColumns)) {
            $databaseColumns = [$databaseColumns];
        }

        if (is_array($databaseColumns)) {
            $this->searches = array_merge($this->searches, $databaseColumns);
            return $this;
        }

        $this->searches = array_merge($this->searches, [$this->property]);
        return $this;
    }

    public function sortable($allowedSorts = null)
    {
        if ($allowedSorts) {
            foreach ($allowedSorts as $key => $allowedSort) {
                $this->sorts = array_merge($this->sorts, $allowedSort);
            }

            return $this;
        }

        $this->sorts = array_merge($this->sorts, Sort::bi($this->property));

        return $this;
    }

    public static function status()
    {
        $column = new self('status');

        $column->setHeader([
            'value' => 'status',
            'text' => trans('general.status'),
            'align' => 'right',
            'sortable' => false
        ]);

        return $column;
    }

    public static function menu()
    {
        $column = new self('menu');

        $column->setHeader([
            'value' => 'menu',
            'text' => trans('datatable.options'),
            'align' => 'right',
            'sortable' => false
        ]);

        return $column;
    }
}
