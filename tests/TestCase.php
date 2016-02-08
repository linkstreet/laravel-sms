<?php

namespace Linkstreet\LaravelSms\Tests;

use Sms;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public $device;

    public $devices;

    public $message;

    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app)
    {
        return ['Linkstreet\LaravelSms\Providers\SmsServiceProvider'];
    }

    /**
     * {@inheritdoc}
     */
    protected function getPackageAliases($app)
    {
        return [
            'Sms' => 'Linkstreet\LaravelSms\Facades\Sms'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->device = Sms::Device('+910000000000');
        $this->testDevice();
        $this->devices = Sms::DeviceCollection([$this->device, Sms::Device('00000')]);
        $this->testDeviceCollection();
        $this->message = Sms::Message('Hello world');
        $this->testMessage();
    }

    /**
     * Test the device model
     */
    public function testDevice()
    {
        $this->assertSame('+910000000001', $this->device->setNumber('+910000000001')->getNumber());
    }

    /**
     * Test the device collection & device
     */
    public function testDeviceCollection()
    {
        $count = 0;
        foreach ($this->devices as $device) {
            $count++;
        }
        $this->assertSame($count, $this->devices->count());
        $this->assertSame($this->device, $this->devices->get('+910000000001'));
    }

    /**
     * Test the message model
     */
    public function testMessage()
    {
        $this->assertSame('Hello world!', $this->message->setMessage('Hello world!')->getMessage());
    }
}
