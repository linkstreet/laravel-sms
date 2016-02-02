<?php

namespace Linkstreet\LaravelSms\Adapters\Kap;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Linkstreet\LaravelSms\Adapters\BaseAdapter;
use Linkstreet\LaravelSms\Contracts\AdapterInterface;
use Linkstreet\LaravelSms\Exceptions\AdapaterException;

/**
 * KapAdapter
 */
class KapAdapter extends BaseAdapter implements AdapterInterface
{
    /**
     * Create a instance of Kap Adapter
     */
    public function __construct()
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function send($devices, $message)
    {
        $this->config = $this->requiredConfig();
        $this->response = (new Client)->send($this->buildRequest(), $this->buildOptions($devices, $message));
        return new KapResponse($devices, json_decode($this->response->getBody()));
    }

    /**
     * Build Guzzle request object
     *
     * @return Request
     */
    private function buildRequest()
    {
        return new Request('POST', 'http://api.kapsystem.com/api/v3/sendsms/json');
    }

    /**
     * Build Guzzle query options with json payload
     *
     * @param DeviceCollection $devices
     * @param Message $message
     * @return array
     */
    private function buildOptions($devices, $message)
    {
        $recipients = [];

        foreach ($devices as $device) {
            $recipients[]['gsm'] = $device->mobileNumber();
        }

        return [
            'debug' => false,
            'timeout' => 10,
            'json' => [
                'authentication' => [
                    'username' => $this->config['username'],
                    'password' => $this->config['password']
                ],
                'messages' => [
                    [
                        'sender' => $this->config['sender'],
                        'text' => $message->getMessage(),
                        'recipients' => $recipients
                    ]
                ]
            ]
        ];
    }

    /**
     * Check & retrive the config for KAP adapter
     *
     * @return array
     */
    private function requiredConfig()
    {
        $config = config('sms.adapter.kap');

        // Check for username in the config
        if (!isset($config['username']) && empty($config['username'])) {
            throw new AdapaterException('Invalid username');
        }

        // Check for password in the config
        if (!isset($config['password']) && empty($config['password'])) {
            throw new AdapaterException('Invalid password');
        }

        // Check for sender id in the config
        if (!isset($config['sender']) && empty($config['sender'])) {
            throw new AdapaterException('Invalid sender id');
        }

        return $config;
    }
}
