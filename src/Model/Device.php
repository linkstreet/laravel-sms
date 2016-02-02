<?php

namespace Linkstreet\LaravelSms\Model;

use Linkstreet\LaravelSms\Contracts\DeviceInterface;

/**
 * Device class
 */
class Device implements DeviceInterface
{
    /**
     * International mobile code
     * @var int
     */
    private $code;

    /**
     * Mobile number
     * @var int
     */
    private $number;

    /**
     * Create an instance of Device
     *
     * @param int $code
     * @param int $number
     */
    public function __construct($code, $number)
    {
        $this->code = $code;
        $this->number = $number;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Linkstreet\LaravelSms\Model\Device
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
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

    /**
     * Get the mobile number with international code with or without pulse
     *
     * @param boolean $withPlus Whether want to add plus to the result
     * @return string
     */
    public function getFormattedNumber($withPlus = false)
    {
        return (($withPlus)? '+' : '').$this->code.$this->number;
    }
}
