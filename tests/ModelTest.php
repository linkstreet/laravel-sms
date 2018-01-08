<?php

namespace Linkstreet\LaravelSms\Tests;

use Linkstreet\LaravelSms\Model\Device;

class ModelTest extends TestCase
{
    /**
     * Test the device model
     */
    public function testDevice()
    {
        $device = new Device('+910000000000', 'IN');
        $this->assertSame('+910000000000', $device->getNumber());
        $this->assertSame('IN', $device->getCountryIso());
        $this->assertSame('910000000000', $device->getNumberWithoutPlusSign());
    }
}
