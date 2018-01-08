<?php

namespace Linkstreet\LaravelSms\Contracts;

use Linkstreet\LaravelSms\Model\Device;

/**
 * AdapterInterface.
 */
interface AdapterInterface
{
    /**
     * Send SMS
     * @param \Linkstreet\LaravelSms\Model\Device $device
     * @param string $message
     * @return ResponseInterface
     */
    public function send(Device $device, string $message): ResponseInterface;
}
