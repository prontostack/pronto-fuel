<?php

namespace App\View\Components;

use App\View\Component;
use App\View\Components\NavLink;

class AccountMenu extends Component
{
    public function __construct()
    {
        $this->items([
            NavLink::to(route('account.profile'))
                ->label(trans('account.profile.label'))
                ->icon('mdiAccountOutline')
                ->active(request()->routeIs('account.profile')),

            NavLink::to(route('account.preferences'))
                ->label(trans('account.preferences.label'))
                ->icon('mdiCogOutline')
                ->active(request()->routeIs('account.preferences')),

            NavLink::to(route('account.security'))
                ->label(trans('account.security.label'))
                ->icon('mdiSecurity')
                ->active(request()->routeIs('account.security'))
        ]);

        $this->logout(
            NavLink::to(route('logout'))
                ->method('post')
                ->label(trans('auth.logout'))
                ->icon('mdiPowerStandby')
        );
    }
}
