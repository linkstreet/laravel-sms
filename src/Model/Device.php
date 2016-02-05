<?php

namespace Linkstreet\LaravelSms\Model;

use Linkstreet\LaravelSms\Contracts\DeviceInterface;

/**
 * Device class
 */
class Device implements DeviceInterface
{
    /**
     * Mobile number
     * @var int
     */
    private $number;

    /**
     * Create an instance of Device
     *
     * @param int $number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * {@inheritdoc}
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Linkstreet\LaravelSms\Model\Device
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }
}
