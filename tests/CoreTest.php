<?php

namespace Linkstreet\LaravelSms\Tests;

use Sms;

class CoreTest extends TestCase
{
    /**
     * Test the device model
     */
    public function testDevice()
    {
        $device = Sms::Device('+910000000000');
        $this->assertSame('+910000000001', $device->setNumber('+910000000001')->getNumber());
    }

    /**
     * Test the device collection & device
     */
    public function testDeviceCollection()
    {
        $number1 = '+910000000001';
        $number2 = '+910000000002';
        $devices = Sms::DeviceCollection([Sms::Device($number1), Sms::Device($number2)]);

        $this->assertSame(2, $devices->count());
        $this->assertSame($number1, $devices->get($number1)->getNumber());
        $this->assertSame($number2, $devices->get($number2)->getNumber());
    }

    /**
     * Test the message model
     */
    public function testMessage()
    {
        $message = Sms::Message('Hello world');
        $this->assertSame('Hello world!', $message->setMessage('Hello world!')->getMessage());
    }
}