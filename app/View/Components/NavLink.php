<?php

namespace App\View\Components;

use App\View\Component;

class NavLink extends Component
{
    public function __construct($url)
    {
        $this->key(uniqid());
        $this->binds['to'] = $url;
    }

    public static function to($url)
    {
        return new static($url);
    }
}
