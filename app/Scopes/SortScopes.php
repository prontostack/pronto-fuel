<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

/**
 * Apply request sorts to the query
 */
trait SortScopes
{
    public function scopeSort(Builder $query, $sorts = [], $defaultSorts = null)
    {
        /**
         * If the request has no sorts, sort by the default sort options
         */
        if (empty($sorts) && $defaultSorts) {
            $sorts = $defaultSorts;
        }

        foreach ($sorts as $key => $sort) {
            $query->sortColumn($sort);
        }

        return $query;
    }

    public function scopeSortColumn(Builder $query, $sort)
    {
        $column = $sort;
        $direction = 'asc';

        /**
         * Handle descending ordering
         */
        if (Str::of($sort)->startsWith('-')) {
            $column = substr($sort, 1);
            $direction = 'desc';
        }

        /**
         * Handle sort for translatable columns
         */
        if (isset($this->translatable) && in_array($column, $this->translatable)) {
            return $query->sortTranslatable($column, $direction);
        }

        if ($direction === 'desc') {
            return $query->orderByDesc($column);
        }

        return $query->orderBy($column);
    }

    public function scopeSortTranslatable($query, $property, $direction = 'asc')
    {
        $query->orderByRaw("cast(" . $property .  "->'" . app()->getLocale() . "' as varchar) " . $direction);
    }
}
