<?php

namespace App\View\Layouts;

use App\View\Component;
use App\View\Components\AccountMenu;
use App\View\Components\Admin\NavDrawer;

class SubscriberLayout extends Component
{
    public function __construct()
    {
        $this->navDrawer(new NavDrawer);

        $this->accountMenu(new AccountMenu);
    }
}
