<?php

namespace App\View\Components\DataTable;

class Sort
{
    public static function bi($value)
    {
        $asc = $value;
        $desc = '-' . $value;

        return [
            [
                'value' => $asc,
                'text' => trans('datatable.sort.' . $asc)
            ],
            [
                'value' => $desc,
                'text' => trans('datatable.sort.' . $desc)
            ]
        ];
    }

    public static function asc($value)
    {
        return [[
            'value' => $value,
            'text' => trans('datatable.sort.' . $value)
        ]];
    }

    public static function desc($value)
    {
        $desc = '-' . $value;

        return [[
            'value' => $desc,
            'text' => trans('datatable.sort.' . $desc)
        ]];
    }
}
