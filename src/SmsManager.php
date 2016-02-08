<?php

namespace Linkstreet\LaravelSms;

use Linkstreet\LaravelSms\Collections\DeviceCollection;
use Linkstreet\LaravelSms\Contracts\AdapterInterface;
use Linkstreet\LaravelSms\Contracts\MessageInterface;

/**
 * SmsManager class to send the sms based on the adapter
 */
class SmsManager
{
    /**
     * @var \Linkstreet\LaravelSms\Contracts\AdapterInterface
     */
    private $adapter;

    /**
     * @var \Linkstreet\LaravelSms\Collections\DeviceCollection
     */
    private $devices;

    /**
     * @var \Linkstreet\LaravelSms\Contracts\MessageInterface
     */
    private $message;

    /**
     * SMS Manager Constructor
     *
     * @param \Linkstreet\LaravelSms\Contracts\AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Add the device collection
     *
     * @param \Linkstreet\LaravelSms\Collections\DeviceCollection $devices
     * @return \Linkstreet\LaravelSms\SmsManager
     */
    public function to(DeviceCollection $devices)
    {
        $this->devices = $devices;

        return $this;
    }

    /**
     * Send the message
     *
     * @param \Linkstreet\LaravelSms\Contracts\MessageInterface $message
     * @return array
     */
    public function send(MessageInterface $message)
    {
        $this->message = $message;

        return $this->adapter->send($this->devices, $this->message);
    }
}
