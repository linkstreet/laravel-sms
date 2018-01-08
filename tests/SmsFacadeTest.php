<?php

namespace Linkstreet\LaravelSms\Tests;

use Linkstreet\LaravelSms\Facades\Sms as SmsFacade;
use Linkstreet\LaravelSms\SmsManager;

class SmsFacadeTest extends TestCase
{
    /** @test */
    public function returnInstanceOfManager()
    {
        $this->assertInstanceOf(SmsManager::class, SmsFacade::create([]));
    }
}
