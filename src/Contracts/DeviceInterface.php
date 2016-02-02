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

    /**
     * Get the mobile number with international code with or without pulse
     *
     * @param boolean $withPlus Whether want to add plus to the result
     * @return string
     */
    public function getFormattedNumber($withPlus = false);
}
