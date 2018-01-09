<?php

namespace Linkstreet\LaravelSms\Exceptions;

class MessageException extends \Exception
{
    /**
     * Message not found
     * @return static
     */
    public static function notFound()
    {
        return new static('Message not found');
    }
}
