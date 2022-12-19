<?php

namespace App\Models;

use App\Scopes\FilterScopes;
use App\Scopes\SortScopes;
use App\Scopes\TimestampScopes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class Admin extends User
{
    use HasFactory, HasParent, FilterScopes, SortScopes, TimestampScopes;

    protected $appends = ['url'];

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => [
                'edit' => route('admin.admins.edit', $attributes['id'])
            ]
        );
    }
}
