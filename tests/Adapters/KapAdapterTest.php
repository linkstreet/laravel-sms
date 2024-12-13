<?php

namespace Linkstreet\LaravelSms\Tests\Adapters;

use Linkstreet\LaravelSms\Adapters\Kap\KapAdapter;
use Linkstreet\LaravelSms\Exceptions\AdapterException;
use Linkstreet\LaravelSms\Model\Device;
use Linkstreet\LaravelSms\Tests\Adapters\HttpClient as MockClient;
use Linkstreet\LaravelSms\Tests\TestCase;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class KapAdapterTest extends TestCase
{
    use MockClient;

    private $config;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->config = [
            'username' => rand(),
            'password' => rand(),
            'sender' => rand(),
            'telemarketer' => rand(),
        ];
    }

    /** @test */
    public function invalidCredentials()
    {
        $config = $this->config;

        $config['username'] = null;

        $adapter = (new KapAdapter($config))->setClient($this->mockClient(400));

        $this->expectException(AdapterException::class);

        $adapter->send(new Device('+910123456789', 'IN'), 'Test message');
    }

    public function invalidDevice()
    {
        $stub = [
            'messages' => [
                [
                    'messageId' => '',
                    'to' => '0010123456789'
                ]
            ]
        ];

        $adapter = (new KapAdapter($this->config))->setClient($this->mockClient(200, $stub));

        $response = $adapter->send(new Device('0010123456789', 'IN'), 'Test message');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertInstanceOf(PsrResponseInterface::class, $response->getRaw());
        $this->assertFalse($response->isSuccess());
        $this->assertTrue($response->isFailure());
        $this->assertEquals(-13, $response->getErrorCode());
        $this->assertNotEmpty($response->getErrorMessage());
        $this->assertSame('OK', $response->getReasonPhrase());
    }

    public function successResponse()
    {
        $stub = [
            'messages' => [
                [
                    'messageId' => '43406163014203536863',
                    'to' => '910123456789',
                    'smsCount' => '1',
                ]
            ]
        ];

        $adapter = (new KapAdapter($this->config))->setClient($this->mockClient(200, $stub));

        $response = $adapter->send(new Device('+910123456789', 'IN'), 'Test message');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertInstanceOf(PsrResponseInterface::class, $response->getRaw());
        $this->assertTrue($response->isSuccess());
        $this->assertFalse($response->isFailure());
        $this->assertEquals(0, $response->getErrorCode());
        $this->assertNotEmpty($response->getErrorMessage());
        $this->assertSame('OK', $response->getReasonPhrase());
    }
}
