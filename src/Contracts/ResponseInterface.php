<?php

namespace Linkstreet\LaravelSms\Contracts;

/**
 * ResponseInterface.
 */
interface ResponseInterface
{
    /**
     * Get the response status code
     *
     * @return int
     */
    public function getStatusCode();

    /**
     * Get success recipient count
     *
     * @return int
     */
    public function getSuccessCount();

    /**
     * Get failure recipient count
     *
     * @return int
     */
    public function getFailureCount();

    /**
     * Get success recipients device
     *
     * @return \Linkstreet\LaravelSms\Collection\DeviceCollection
     */
    public function getSuccessRecipient();

    /**
     * Get failure recipients device
     *
     * @return \Linkstreet\LaravelSms\Collection\DeviceCollection
     */
    public function getFailureRecipient();

    /**
     * Get total no of devices
     *
     * @return int
     */
    public function getDeviceCount();

    /**
     * Get raw response
     *
     * @return stdClass
     */
    public function getRaw();
}
