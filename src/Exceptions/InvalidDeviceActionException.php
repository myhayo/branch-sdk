<?php

namespace Myhayo\Branch\Exceptions;

class InvalidDeviceActionException extends Exception
{
    /**
     * Bootstrap.
     *
     * @param string $message
     *
     * @author yansongda <me@yansonga.cn>
     *
     */
    public function __construct($message = '')
    {
        parent::__construct($message ?: 'INVALID_DEVICE_ACTION', self::INVALID_DEVICE_ACTION);
    }
}
