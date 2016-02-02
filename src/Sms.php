<?php

namespace Linkstreet\LaravelSms;

use Linkstreet\LaravelSms\Adapters\Kap\KapAdapter;
use Linkstreet\LaravelSms\Collection\DeviceCollection;
use Linkstreet\LaravelSms\Contracts\AdapterInterface;
use Linkstreet\LaravelSms\Model\Device;
use Linkstreet\LaravelSms\Model\Message;

/**
* Class SMS
*/
class Sms
{
    /**
     * Get SmsManager Class object
     *
     * @param AdapterInterface $adapter
     * @return \Linkstreet\LaravelSms\SmsManager
     */
    public function manager($adapter)
    {
        return new SmsManager($adapter);
    }

    /**
     * Create a new Message
     *
     * @param  [type] $message [description]
     * @return \Linkstreet\LaravelSms\Model\Message
     */
    public function message($message)
    {
        return new Message($message);
    }

    /**
     * Create a new device
     *
     * @param int $code International mobile code
     * @param int $number mobile number
     * @return \Linkstreet\LaravelSms\Model\Device
     */
    public function device($code, $number)
    {
        return new Device($code, $number);
    }

    /**
     * Create a new device collection
     *
     * @param  array  $devices [description]
     * @return \Linkstreet\LaravelSms\Collection\DeviceCollection
     */
    public function deviceCollection(array $devices)
    {
        return new DeviceCollection($devices);
    }

    /**
     * KAP SYSTEM Adapter
     *
     * @return \Linkstreet\LaravelSms\Adapters\Kap\KapAdapter
     */
    public function kapAdapter()
    {
        return new KapAdapter();
    }
}
