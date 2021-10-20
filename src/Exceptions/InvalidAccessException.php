<?php

namespace Myhayo\Branch\Exceptions;

class InvalidAccessException extends Exception
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
        parent::__construct($message ?: 'INVALID_ACCESS', self::INVALID_ACCESS);
    }
}
