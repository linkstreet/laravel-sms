<?php

namespace Linkstreet\LaravelSms\Contracts;

/**
 * Device interface
 */
interface DeviceInterface
{
    /**
     * Getter method for number
     *
     * @return int
     */
    public function getNumber();

    /**
     * Setter method for number
     *
     * @param int $number
     * @return \Linkstreet\LaravelSms\Model\Device
     */
    public function setNumber($number);
}
