<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

/**
 * Apply request filters to query
 */
trait FilterScopes
{
    public function scopeFilter(Builder $query, $filters)
    {
        /**
         * Return the Query Builder if there are no filters
         */
        if (!$filters) {
            return $query;
        }

        foreach ($filters as $key => $value) {
            $scope = Str::camel($key);
            $method = 'scope' . ucfirst($scope);

            if (!method_exists($this, $method)) {
                continue;
            }

            $query->{$scope}($value);
        }

        return $query;
    }
}
