<?php

namespace Linkstreet\LaravelSms;

use Linkstreet\LaravelSms\Adapters\Adapter;
use Linkstreet\LaravelSms\Contracts\AdapterInterface;
use Linkstreet\LaravelSms\Contracts\ResponseInterface;
use Linkstreet\LaravelSms\Exceptions\AdapterException;
use Linkstreet\LaravelSms\Exceptions\DeviceException;
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
     * Add the device collection
     *
     * @param \Linkstreet\LaravelSms\Model\Device $device
     * @return self
     */
    public function to(Device $device): self
    {
        $this->device = $device;

        return $this;
    }

    /**
     * Send the message
     * @param string $message
     * @return ResponseInterface
     * @throws AdapterException
     * @throws DeviceException
     */
    public function send(string $message): ResponseInterface
    {
        if (null === $this->device) {
            throw DeviceException::notFound();
        }

        $this->connection = $this->connection ?? $this->resolveConnection($this->device);

        return $this->getAdapter($this->connection)->send($this->device, $message);
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

        return $connection ?: AdapterException::noPossibleConnection($device);
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
