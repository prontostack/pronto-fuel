<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

trait TimestampScopes
{
    public function scopeCreatedAfter(Builder $query, $date): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date));
    }

    public function scopeCreatedBefore(Builder $query, $date): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date)->addDay()->subSecond());
    }

    public function scopeCreatedBetween(Builder $query, $dates = null): Builder
    {
        return $query->whereDateIsBetween('created_at', $dates);
    }

    public function scopeUpdatedAfter(Builder $query, $date): Builder
    {
        return $query->where('updated_at', '>=', Carbon::parse($date));
    }

    public function scopeUpdatedBefore(Builder $query, $date): Builder
    {
        return $query->where('updated_at', '<=', Carbon::parse($date)->addDay()->subSecond());
    }

    public function scopeUpdatedBetween(Builder $query, $dates = null): Builder
    {
        return $query->whereDateIsBetween('updated_at', $dates);
    }

    public function scopeWhereDateIsBetween(Builder $query, $field = 'created_at', $dates = null)
    {
        $date1 = null;
        $date2 = null;

        if (Str::of($dates)->contains(',')) {
            list($date1, $date2) = explode(',', $dates);
        } else {
            $date1 = $dates;
        }

        if (!$date1 && !$date2) {
            return $query;
        }

        if ($date1 && !$date2) {
            return $query->whereDate($field, Carbon::parse($date1));
        }

        $from = Carbon::parse(min($date1, $date2));
        $to = Carbon::parse(max($date1, $date2))->addDay()->subMicrosecond();

        return $query->whereBetween($field, [$from, $to]);
    }
}
