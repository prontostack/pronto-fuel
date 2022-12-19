<?php

namespace App\View\Components\Subscriber;

use App\View\Component;
use App\View\Components\NavLink;

class NavDrawer extends Component
{
    public function __construct()
    {
        $this->items([
            NavLink::to(route('subscriber.dashboard'))
                ->label(trans('dashboard.label'))
                ->icon('mdiHomeOutline')
                ->active(request()->routeIs('subscriber.dashboard'))
        ]);
    }
}
