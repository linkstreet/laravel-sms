<?php

namespace Linkstreet\LaravelSms\Adapters;

use GuzzleHttp\Client;

/**
 * BaseAdapter
 */
abstract class BaseAdapter
{
    protected $client;

    protected $config;

    protected $response;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
