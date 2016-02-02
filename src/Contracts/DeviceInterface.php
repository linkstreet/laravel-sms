<?php

namespace Linkstreet\LaravelSms\Contracts;

/**
 * Device interface
 */
interface DeviceInterface
{
    /**
     * Getter method of code
     *
     * @return int
     */
    public function getCode();

    /**
     * Setter method for code
     *
     * @param int $code
     * @return \Linkstreet\LaravelSms\Model\Device
     */
    public function setCode($code);

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
