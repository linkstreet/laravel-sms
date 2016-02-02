<?php

namespace Linkstreet\LaravelSms\Model;

use Linkstreet\LaravelSms\Contracts\MessageInterface;

/**
 * Message class
 */
class Message implements MessageInterface
{
    /**
     * Message text to send
     * @var string
     */
    private $message;

    /**
     * Create an instance of Message class
     *
     * @param string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Linkstreet\LaravelSms\Model\Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}
