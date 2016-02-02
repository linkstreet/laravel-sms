<?php

namespace Linkstreet\LaravelSms\Contracts;

/**
 * AdapterInterface.
 */
interface AdapterInterface
{
    /**
     * Send SMS
     *
     * @param \Linkstreet\LaravelSms\Collection\DeviceCollection $devices
     * @param \Linkstreet\LaravelSms\Contracts\MessageInterface $message
     * @param array
     */
    public function send($devices, $message);
}
