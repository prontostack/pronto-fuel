<?php

namespace App\View\Components\Admin;

use App\View\Component;
use App\View\Components\NavLink;

class NavDrawer extends Component
{
    public function __construct()
    {
        $this->items([
            NavLink::to(route('admin.dashboard'))
                ->label(trans('dashboard.label'))
                ->icon('mdiHomeOutline')
                ->active(request()->routeIs('admin.dashboard')),

            NavLink::to(route('admin.admins.index'))
                ->label(trans('user.admin.bulk.label'))
                ->icon('mdiAccountGroupOutline')
                ->active(request()->routeIs('admin.admins*'))
        ]);
    }
}
