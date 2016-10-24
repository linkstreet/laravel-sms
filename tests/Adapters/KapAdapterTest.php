<?php

namespace Linkstreet\LaravelSms\Tests\Adapters;

use Linkstreet\LaravelSms\Tests\TestCase;
use Sms;

class KapAdapterTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('sms.adapter.kap', [
            'username' => rand(),
            'password' => rand(),
            'sender' => 'FEDCBA'
        ]);
    }

    /**
     * @test
     * @expectedException Linkstreet\LaravelSms\Exceptions\AdapterException
     */
    public function emptyUsernameConfig()
    {
        Sms::kapAdapter(['username' => '']);
    }

    /**
     * @test
     * @expectedException Linkstreet\LaravelSms\Exceptions\AdapterException
     */
    public function emptyPasswordConfig()
    {
        Sms::kapAdapter(['username' => 'test', 'password' => '']);
    }

    /**
     * @test
     * @expectedException Linkstreet\LaravelSms\Exceptions\AdapterException
     */
    public function emptySenderConfig()
    {
        Sms::kapAdapter(['username' => 'test', 'password' => 'test', 'sender' => '']);
    }

    /**
     * @test
     */
    public function sendSms()
    {
        $stub = Sms::kapAdapter();

        // Create a mock and queue two responses.
        $mock = new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(
                200,
                ['Content-type' => 'application/json'],
                json_encode(
                    [
                        'results' => [
                            [
                                'status' => 0,
                                'message_id' => '12312314122',
                                'destination' => '+910000000001'
                            ],
                            [
                                'status' => -13,
                                'message_id' => '',
                                'destination' => '00000'
                            ]
                        ]
                    ]
                )
            ),
        ]);

        // Configure the stub.
        $stub->setClient(new \GuzzleHttp\Client(['handler' => \GuzzleHttp\HandlerStack::create($mock)]));

        $response = Sms::app($stub)
            ->to(Sms::DeviceCollection([Sms::Device('+910000000001'), Sms::Device('00000')]))
            ->send(Sms::Message('Hello world'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue((bool) $response->getSuccessCount());
        $this->assertTrue((bool) $response->getFailureCount());
        $this->assertCount(1, $response->getSuccessRecipient());
        $this->assertCount(1, $response->getFailureRecipient());
        $this->assertObjectHasAttribute('results', json_decode($response->getRaw()->getBody()));
        $this->assertEquals(2, $response->getDeviceCount());
    }
}
