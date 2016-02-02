<?php

namespace Linkstreet\LaravelSms\Collection;

use Linkstreet\LaravelSms\Contracts\DeviceInterface;

class DeviceCollection implements \IteratorAggregate
{
    /**
     * @var array
     */
    private $devices;

    /**
     * Constructor
     *
     * @param array $devices Array of Device Model
     */
    public function __construct(array $devices = [])
    {
        foreach ($devices as $device) {
            $this->add($device);
        }
    }

    /**
     * Add device into the collection
     *
     * @param DeviceInterface $device
     */
    public function add(DeviceInterface $device)
    {
        $this->devices[$device->getFormattedNumber()] = $device;
    }

    /**
     * Countable
     *
     * @return int
     */
    public function count()
    {
        return count($this->devices);
    }

    /**
     * Get value based on the key
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return isset($this->devices[$key]) ? $this->devices[$key] : null;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->devices);
    }
}
