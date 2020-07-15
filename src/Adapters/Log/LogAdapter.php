<?php

namespace Linkstreet\LaravelSms\Adapters\Log;

use Illuminate\Support\Facades\Log;
use Linkstreet\LaravelSms\Contracts\AdapterInterface;
use Linkstreet\LaravelSms\Contracts\ResponseInterface;
use Linkstreet\LaravelSms\Model\Device;

class LogAdapter implements AdapterInterface
{
    public function send(Device $device, string $message): ResponseInterface
    {
        Log::debug('SMS', [
            'device' => $device->toArray(),
            'message' => $message,
        ]);

        return new LogResponse($device, $message);
    }
}
