<?php

namespace App\DataTables\Admin;

use App\Models\Admin;
use App\View\Components\DataTable\Column;
use App\View\Components\DataTable\Filter;
use App\View\Components\DataTable\Sort;
use App\View\Components\DataTable\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminDataTable extends Table
{
    protected function columns()
    {
        return [
            Column::for('name')
                ->labeled(trans('common.name'))
                ->searchable(['name'])
                ->sortable([Sort::bi('name')]),
            // Column::for('username')
            //     ->labeled(trans('user.username')),
            // Column::for('roles')
            //     ->labeled(trans('user.role.bulk.label')),
            Column::for('created_at')
                ->sortable(),
            Column::for('updated_at')
                ->sortable(),
            Column::menu()
        ];
    }

    protected function filters()
    {
        return [
            Filter::search(),
            Filter::createdBetween(),
            Filter::updatedBetween(),
        ];
    }

    protected function defaultSorts()
    {
        return [
            Sort::asc('name')
        ];
    }

    protected function query()
    {
        // return Admin::with('roles');
        return Admin::query();
    }

    protected function partialReloads()
    {
        return ['adminDataTable'];
    }

    protected function transformResults($results)
    {
        // $items = $results->getCollection()->filter(function ($admin) {
        //     return Auth::user()->can('view', $admin);
        // })->values();

        // $results->setCollection($items);

        return $results;
    }

    protected function getUrlToIndexAttribute()
    {
        return route('admin.admins.index');

        // return (Auth::user()->can('viewAny', Admin::class))
        //     ? route('admin.admins.index')
        //     : null;
    }

    protected function getUrlToCreateAttribute()
    {
        return route('admin.admins.create');

        // return (Auth::user()->can('create', Admin::class))
        //     ? route('admin.admins.create')
        //     : null;
    }

    protected function getUrlToBulkDestroyAttribute()
    {
        // return route('admin.admins.bulkDestroy');
    }

    protected function getConfirmBulkDestroyMessageAttribute()
    {
        // return trans('general.confirm_bulk_destroy', [
        //     'subjects' => Str::lower(trans('user.admin.bulk.label'))
        // ]);
    }
}
