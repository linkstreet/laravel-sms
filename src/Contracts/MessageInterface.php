<?php

namespace Linkstreet\LaravelSms\Contracts;

/**
 * Message interface
 */
interface MessageInterface
{
    /**
     * Getter method for message
     *
     * @return string
     */
    public function getMessage();

    /**
     * Setter method for message
     *
     * @param string $message
     */
    public function setMessage($message);
}
