<?php

namespace Linkstreet\LaravelSms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * SMS Facade class
 */
class Sms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sms';
    }
}
