<?php

namespace Linkstreet\LaravelSms\Adapters\Kap;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Config;
use Linkstreet\LaravelSms\Adapters\BaseAdapter;
use Linkstreet\LaravelSms\Contracts\AdapterInterface;
use Linkstreet\LaravelSms\Exceptions\AdapterException;

/**
 * KapAdapter
 */
class KapAdapter extends BaseAdapter implements AdapterInterface
{
    /**
     * Create a instance of Kap Adapter
     *
     * @param array|null configuration for KAP adapter
     */
    public function __construct($config = null)
    {
        $this->config = $this->requiredConfig($config);
    }

    /**
     * {@inheritdoc}
     */
    public function send($devices, $message)
    {
        $this->response = $this->client->send($this->buildRequest(), $this->buildOptions($devices, $message));
        return new KapResponse($devices, $this->response);
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
            $recipients[]['gsm'] = $device->getNumber();
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
     * Check & retrieve the config for KAP adapter
     *
     * @param array|null configuration for KAP adapter
     * @return array
     * @throws AdapaterException
     */
    private function requiredConfig($config = null)
    {
        if (is_null($config)) {
            $config = Config::get('sms.adapter.kap');
        }

        // Check for username in the config
        if (!isset($config['username']) || empty($config['username'])) {
            throw new AdapterException('Invalid username');
        }

        // Check for password in the config
        if (!isset($config['password']) || empty($config['password'])) {
            throw new AdapterException('Invalid password');
        }

        // Check for sender id in the config
        if (!isset($config['sender']) || empty($config['sender'])) {
            throw new AdapterException('Invalid sender id');
        }

        return $config;
    }
}
