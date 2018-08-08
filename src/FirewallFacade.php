<?php

namespace NV\Firewall;

use Illuminate\Support\Facades\Facade;

class FirewallFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'firewall';
    }
}