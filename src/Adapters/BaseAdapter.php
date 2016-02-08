<?php

namespace Linkstreet\LaravelSms\Adapters;

/**
 * BaseAdapter
 */
abstract class BaseAdapter
{
    protected $client;

    protected $config;

    protected $response;

    public function setClient($client)
    {
        $this->client = $client;
    }
}
