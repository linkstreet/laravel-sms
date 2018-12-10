<?php

namespace Linkstreet\LaravelSms;

use Linkstreet\LaravelSms\Adapters\Adapter;
use Linkstreet\LaravelSms\Contracts\AdapterInterface;
use Linkstreet\LaravelSms\Contracts\ResponseInterface;
use Linkstreet\LaravelSms\Exceptions\AdapterException;
use Linkstreet\LaravelSms\Exceptions\DeviceException;
use Linkstreet\LaravelSms\Exceptions\MessageException;
use Linkstreet\LaravelSms\Model\Device;

/**
 * SmsManager class to send the sms based on the adapter
 */
class SmsManager
{
    /**
     * Connection name
     * @var string
     */
    private $connection;

    /**
     * @var \Linkstreet\LaravelSms\Model\Device
     */
    private $device;

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    private $config;

    /**
     * SmsManager constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param array $config
     * @return static
     */
    public static function create(array $config)
    {
        return new static($config);
    }

    /**
     * Set connection
     * @param string $connection
     * @return self
     * @throws AdapterException
     */
    public function connection(string $connection): self
    {
        if (!$this->isConnectionExists($connection)) {
            throw AdapterException::unknownConnection($connection);
        }

        $this->connection = $connection;

        return $this;
    }

    /**
     * Add device
     * @param \Linkstreet\LaravelSms\Model\Device $device
     * @return self
     */
    public function to(Device $device): self
    {
        $this->device = $device;

        return $this;
    }

    /**
     * Add message
     * @param string $message
     * @return $this
     */
    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Dispatch the sms message via adapter
     * @return ResponseInterface
     * @throws AdapterException
     * @throws DeviceException
     * @throws MessageException
     */
    public function dispatch(): ResponseInterface
    {
        if (null === $this->device) {
            throw DeviceException::notFound();
        }

        if (null === $this->message) {
            throw MessageException::notFound();
        }

        $connection = $this->connection ?? $this->resolveConnection($this->device);

        return $this->getAdapter($connection)->send($this->device, $this->message);
    }

    /**
     * Send a sms
     * @param Device $device
     * @param string $message
     * @return ResponseInterface
     * @throws AdapterException
     * @throws DeviceException
     * @throws MessageException
     */
    public function send(Device $device, string $message): ResponseInterface
    {
        return $this->to($device)
            ->message($message)
            ->dispatch();
    }

    /**
     * Connection existence
     * @param string $connection
     * @return bool
     */
    private function isConnectionExists(string $connection): bool
    {
        return isset($this->config['connections'][$connection]);
    }

    /**
     * Resolve connection based on priority
     * @param Device $device
     * @return string
     */
    public function resolveConnection(Device $device): string
    {
        $priority = $this->config['priority'];

        $connections = $priority[$device->getCountryIso()] ?? $this->config['default'];

        if (!is_array($connections)) {
            $connections = [$connections];
        }

        foreach ($connections as $connection) {
            if ($this->isConnectionExists($connection)) {
                break;
            }
        }

        return isset($connection)
            ? $connection
            : AdapterException::noPossibleConnection($device);
    }

    /**
     * Get adapter for the connection
     * @param string $connection
     * @return AdapterInterface
     * @throws AdapterException
     */
    public function getAdapter(string $connection): AdapterInterface
    {
        $properties = $this->config['connections'][$connection];

        $class = Adapter::find($properties['adapter']);

        return new $class($properties);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'connection' => $this->connection,
            'device' => is_null($this->device) ?: $this->device->toArray(),
        ];
    }
}
