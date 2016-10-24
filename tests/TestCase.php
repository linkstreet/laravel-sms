<?php

namespace Linkstreet\LaravelSms\Tests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
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
}
