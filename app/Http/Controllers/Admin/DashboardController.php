<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\View\Component;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $title = trans('dashboard.label');

        $registeredUsersCard = (new Component())
            ->color('accent')
            ->title(trans('dashboard.registered_users'))
            ->text(User::count());

        $registeredUsersCardTest = (new Component())
            ->color('primary-darken-1')
            ->title(trans('dashboard.registered_users'))
            ->text(User::count());

        return Inertia::render('Admin/Dashboard', compact([
            'title',
            'registeredUsersCard',
            'registeredUsersCardTest'
        ]));
    }
}
